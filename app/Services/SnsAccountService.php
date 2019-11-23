<?php

namespace App\Services;

use App\Repositories\SnsAccount;
use App\Repositories\User;
use Illuminate\Support\Facades\DB;

class SnsAccountService implements SnsAccountServiceInterface
{
	/**
	 * @param string $id
	 * @return mixed
	 */
	public function findSnsAccountById(string $id)
	{
		return SnsAccount::where('provider_user_id', $id)->first();
	}

	/**
	 * @param string $providerUserId
	 * @param string $name
	 * @param string $nickName
	 * @param string $avatar
	 * @return User
	 */
	public function createSnsAccount(string $providerUserId, string $name, string $nickName, string $avatar): User
	{
		$user = new User();
		$user->name = $name;
		$user->nickname = $nickName;
		$user->avatar = $avatar;

		$snsAccount = new SnsAccount();
		$snsAccount->provider_user_id = $providerUserId;

		DB::transaction(function () use ($user, $snsAccount) {
			$user->save();
			$user->snsAccounts()->save($snsAccount);
		});

		return $user;
	}
}