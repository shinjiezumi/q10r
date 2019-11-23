<?php

namespace App\Services;

use App\Repositories\User;

interface SnsAccountServiceInterface
{
	/**
	 * @param string $id
	 * @return mixed
	 */
	public function findSnsAccountById(string $id);

	/**
	 * @param string $providerUserId
	 * @param string $name
	 * @param string $nickName
	 * @param string $avatar
	 * @return User
	 */
	public function createSnsAccount(string $providerUserId, string $name, string $nickName, string $avatar): User;
}