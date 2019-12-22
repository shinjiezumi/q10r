<?php

namespace App\Services;

use App\Events\AccountCreated;
use App\Exceptions\QiitaApiException;
use App\Repositories\QiitaAccount;
use App\Repositories\QiitaApiToken;
use App\Repositories\QiitaItem;
use App\Repositories\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class QiitaService implements QiitaServiceInterface
{
    /**
     * @var
     */
    private $qiitaApiService;

    /**
     * QiitaService constructor.
     * @param QiitaApiServiceInterface $qiitaApiService
     */
    public function __construct(QiitaApiServiceInterface $qiitaApiService)
    {
        $this->qiitaApiService = $qiitaApiService;
    }

    /**
	 * {@inheritDoc}
	 */
	public function findAccountById(string $id)
	{
		return QiitaAccount::where('qiita_user_id', $id)->first();
	}

    /**
     * {@inheritDoc}
     */
	public function createAccount(SocialiteUser $providerUser): User
	{
		$user = new User();
		$user->name = $providerUser->getName();
		$user->nickname = $providerUser->getNickname();
		$user->avatar = $providerUser->getAvatar();

		$qiitaAccount = new QiitaAccount();
        $qiitaAccount->qiita_user_id = $providerUser->getId();

		$qiitaApiToken = new QiitaApiToken();
		$qiitaApiToken->token = $providerUser->token;

		DB::transaction(function () use ($user, $qiitaAccount, $qiitaApiToken) {
			$user->save();
			$user->qiitaAccounts()->save($qiitaAccount);
			$qiitaAccount->qiitaApiToken()->save($qiitaApiToken);

			$data = [
				'user_id' => $user->id,
				'qiita_user_id' => $qiitaAccount->qiita_user_id
			];
			event(new AccountCreated($data));
		});

		return $user;
	}

    /**
     * {@inheritDoc}
     */
    public function storeAccessToken(QiitaAccount $qiitaAccount, SocialiteUser $providerUser): void
    {
        $qiitaAccount->qiitaApiToken()->update(['token' => $providerUser->token]);
    }

    /**
     * {@inheritDoc}
     */
    public function getItems(array $params): array
    {
        return [];
    }

	/**
	 * {@inheritDoc}
	 */
    public function import(array $data): array
	{
        $path = "/api/v2/users/{$data['qiita_user_name']}/stocks";
        $params = [
            'per_page' => 100
        ];

        // データ取得
        $userId = $data['user_id'];
        $allItems = collect();
        $allUsers = collect();
        $i = 0;
        while(1) {
            $params['page'] = ($i + 1);
            $response = $this->qiitaApiService->callApi('get', $path, $params);

            if ($response['statusCode'] !== 200) {
                throw new QiitaApiException($response['error'], $response['statusCode']);
            }

            $items = [];
            $users = [];
            foreach ($response['body'] as $item) {
                $convertedItem = $this->convertItem($item);
                $items = array_merge($items, $convertedItem['item']);
                $users = array_merge($users, $convertedItem['user']);
            }

            $allItems = $allItems->merge($items);
            $allUsers = $allUsers->merge($users);
            $i++;

            if (!$this->hasNextPage($response['headers']) || $i > 100) {
                break;
            }
        }

        $now = Carbon::now()->format(Carbon::DEFAULT_TO_STRING_FORMAT);
        DB::transaction(function () use ($userId, $allItems, $allUsers, $now) {
            foreach ($allItems as $item) {
                DB::table('qiita_items')->updateOrInsert(['item_id' => $item['item_id']], $item);
            }
            foreach ($allUsers as $user) {
                DB::table('qiita_users')->updateOrInsert(['user_id' => $user['user_id']], $user);
            }

            $qiitaItems = QiitaItem::whereIn('item_id', $allItems->keys())->get();
            $relations = [];
            foreach ($qiitaItems as $qiitaItem) {
                $relations[] = [
                    'user_id' => $userId,
                    'qiita_item_id' => $qiitaItem->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            DB::table('user_qiita_item')->insertOrIgnore($relations);
        });

        return [
            'status' => 'ok',
            'message' => 'インポート処理が完了しました。',
        ];
	}

    /**
     * @param array|null $headers
     * @return bool
     */
    private function hasNextPage(array $headers = null) :bool
    {
        if (!isset($headers['Link'])) {
            false;
        }
        $links = explode(",", Arr::get($headers, "Link.0", ""));
        $regex = "{<(https://.*)>; rel=\"(.*)\"}";
        $pageInfo = [];
        foreach ($links as $link) {
            if (preg_match($regex, $link, $matches)) {
                $pageInfo[$matches[2]] = $matches[1];
            }
        }

        return isset($pageInfo['next']);
    }

    /**
     * @param array $item
     * @return array
     * @throws \Exception
     */
	private function convertItem(array $item) :array
    {
        $itemId = Arr::get($item, 'id');
        $now = Carbon::now()->format(Carbon::DEFAULT_TO_STRING_FORMAT);
        $convertedItem = [
            $itemId => [
                'item_id' => $itemId,
                'title' => Arr::get($item, 'title'),
                'url' => Arr::get($item, 'url'),
                'tags' => json_encode(Arr::get($item, 'tags')),
                'user_id' => Arr::get($item, 'user.id'),
                'item_created_at' => (new Carbon(Arr::get($item, 'created_at')))->format(Carbon::DEFAULT_TO_STRING_FORMAT),
                'item_updated_at' => (new Carbon(Arr::get($item, 'updated_at')))->format(Carbon::DEFAULT_TO_STRING_FORMAT),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $userId = Arr::get($item, 'user.id');
        $convertedUser = [
            $userId => [
                'user_id' => $userId,
                'profile_image_url' => Arr::get($item, 'user.profile_image_url'),
                'followers_count' => Arr::get($item, 'user.followers_count'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        return [
            'item' => $convertedItem,
            'user' => $convertedUser,
        ];
    }
}