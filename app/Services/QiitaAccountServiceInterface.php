<?php

namespace App\Services;

use App\Repositories\QiitaAccount;
use App\Repositories\User;
use Laravel\Socialite\Contracts\User as SocialiteUser;

interface QiitaAccountServiceInterface
{
	/**
	 * @param string $id
	 * @return mixed
	 */
	public function findAccountById(string $id);

    /**
     * @param SocialiteUser $providerUser
     * @return User
     */
	public function createAccount(SocialiteUser $providerUser): User;

    /**
     * @param QiitaAccount $qiitaAccount
     * @param SocialiteUser $providerUser
     */
	public function storeAccessToken(QiitaAccount $qiitaAccount, SocialiteUser $providerUser) :void;
}