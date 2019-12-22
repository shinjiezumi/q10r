<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Repositories\QiitaAccount
 *
 * @property int $id
 * @property int $user_id
 * @property string $qiita_user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Repositories\QiitaApiToken $qiitaApiToken
 * @property-read \App\Repositories\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaAccount whereQiitaUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaAccount whereUserId($value)
 * @mixin \Eloquent
 */
class QiitaAccount extends Model
{
    public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function qiitaApiToken()
    {
        return $this->hasOne(QiitaApiToken::class);
    }
}
