<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

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
 * @mixin \Eloquent
 */
class Tag extends Model
{
    //
}
