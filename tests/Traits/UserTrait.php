<?php

namespace Tests\Traits;

use App\Repositories\QiitaAccount;
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

		$qiitaAccount = new QiitaAccount();
		$qiitaAccount->qiita_user_id = 'provider';

		DB::transaction(function () use ($user, $qiitaAccount) {
			$user->save();
			$user->qiitaAccounts()->save($qiitaAccount);
		});

		return $user;
    }
}
