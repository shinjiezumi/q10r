<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

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
