<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

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
class QiitaItem extends Model
{
    public function qiitaUser()
    {
        return QiitaUser::where('user_id', '=', $this->user_id);
    }
}
