<?php

namespace App\Services;

use App\Repositories\QiitaAccount;
use App\Repositories\QiitaApiToken;
use App\Repositories\User;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class QiitaAccountService implements QiitaAccountServiceInterface
{
	/**
	 * @param string $id
	 * @return mixed
	 */
	public function findAccountById(string $id)
	{
		return QiitaAccount::where('qiita_user_id', $id)->first();
	}

    /**
     * @param SocialiteUser $providerUser
     * @return User
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
		});

		return $user;
	}

    /**
     * @param QiitaAccount $qiitaAccount
     * @param SocialiteUser $providerUser
     */
    public function storeAccessToken(QiitaAccount $qiitaAccount, SocialiteUser $providerUser): void
    {
        $qiitaAccount->qiitaApiToken()->update(['token' => $providerUser->token]);
    }
}