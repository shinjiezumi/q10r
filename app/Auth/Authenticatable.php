<?php
namespace App\Auth;

use Illuminate\Foundation\Auth\User as BaseAuthenticatable;

class Authenticatable extends BaseAuthenticatable
{
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

	/**
	 * @return mixed
	 */
	public function getQiitaUserId()
	{
		return $this->qiita_user_id;
	}

	/**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }
}