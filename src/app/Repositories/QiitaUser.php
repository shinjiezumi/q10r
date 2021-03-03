<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

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
class QiitaUser extends Model
{
    //
}
