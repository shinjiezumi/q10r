<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Repositories\QiitaApiToken
 *
 * @property int $id
 * @property int $qiita_account_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Repositories\QiitaAccount $qiitaAccount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaApiToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaApiToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaApiToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaApiToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaApiToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaApiToken whereQiitaAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaApiToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaApiToken whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class QiitaApiToken extends Model
{
    public function qiitaAccount()
	{
		return $this->belongsTo(QiitaAccount::class);
	}
}
