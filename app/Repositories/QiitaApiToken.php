<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class QiitaApiToken extends Model
{
    public function qiitaAccount()
	{
		return $this->belongsTo(QiitaAccount::class);
	}
}
