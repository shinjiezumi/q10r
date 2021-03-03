<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Auth{
/**
 * App\Auth\Authenticatable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auth\Authenticatable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auth\Authenticatable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Auth\Authenticatable query()
 * @mixin \Eloquent
 */
	class Authenticatable extends \Eloquent {}
}

namespace App\Repositories{
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
	class QiitaAccount extends \Eloquent {}
}

namespace App\Repositories{
/**
 * App\Repositories\Tag
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Repositories{
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
	class User extends \Eloquent {}
}

namespace App\Repositories{
/**
 * App\Repositories\QiitaUser
 *
 * @property int $id
 * @property string $user_id
 * @property string $profile_image_url
 * @property int $followers_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser whereFollowersCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser whereProfileImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaUser whereUserId($value)
 * @mixin \Eloquent
 */
	class QiitaUser extends \Eloquent {}
}

namespace App\Repositories{
/**
 * App\Repositories\QiitaItem
 *
 * @property int $id
 * @property string $item_id
 * @property string $title
 * @property string $url
 * @property mixed $tags
 * @property string $user_id
 * @property string $item_created_at
 * @property string $item_updated_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereItemCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereItemUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repositories\QiitaItem whereUserId($value)
 * @mixin \Eloquent
 */
	class QiitaItem extends \Eloquent {}
}

namespace App\Repositories{
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
	class QiitaApiToken extends \Eloquent {}
}

