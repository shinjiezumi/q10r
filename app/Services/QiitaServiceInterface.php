<?php

namespace App\Services;

use App\Repositories\QiitaAccount;
use App\Repositories\User;
use Laravel\Socialite\Contracts\User as SocialiteUser;

interface QiitaServiceInterface
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

    /**
     * @param array $params
     * @return array
     */
	public function getItems(array $params) :array;

	/**
	 * @return array
	 */
	public function getTags() :array;

	/**
     * @param array $data
     * @return array
     */
	public function import(array $data) :array;
}