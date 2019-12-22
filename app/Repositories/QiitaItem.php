<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class QiitaItem extends Model
{
    public function qiitaUser()
    {
        return $this->hasOne(QiitaUser::class);
    }
}
