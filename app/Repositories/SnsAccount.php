<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class SnsAccount extends Model
{
    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
