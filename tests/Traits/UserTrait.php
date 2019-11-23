<?php

namespace Tests\Traits;

use App\Repositories\SnsAccount;
use App\Repositories\User;
use Illuminate\Support\Facades\DB;

trait UserTrait
{
    public function createUser()
    {
		$user = new User();
		$user->name = 'hoge';
		$user->nickname = 'hogehoge';
		$user->avatar = 'https://example.com/hoge.png';

		$snsAccount = new SnsAccount();
		$snsAccount->provider_user_id = 'provider';

		DB::transaction(function () use ($user, $snsAccount) {
			$user->save();
			$user->snsAccounts()->save($snsAccount);
		});

		return $user;
    }
}
