<?php
namespace App\Auth;

use Illuminate\Foundation\Auth\User as BaseAuthenticatable;

/**
 * App\Auth\Authenticatable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auth\Authenticatable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auth\Authenticatable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auth\Authenticatable query()
 * @mixin \Eloquent
 */
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