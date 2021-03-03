<?php

namespace App\Repositories;

use App\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Repositories\User
 *
 * @property int $id
 * @property string $nickname
 * @property string $name
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property string $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Repositories\QiitaAccount[] $qiitaAccounts
 * @property-read int|null $qiita_accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Repositories\QiitaItem[] $qiitaItems
 * @property-read int|null $qiita_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function qiitaAccounts()
	{
		return $this->hasMany(QiitaAccount::class);
	}

    public function qiitaItems()
    {
        return $this->belongsToMany(QiitaItem::class, 'user_qiita_item');
    }
}
