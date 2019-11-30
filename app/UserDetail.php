<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
			'user_id',
	        'fono',
	        'codigo',
    ];

    public function getUserAttribute()
    {
    	$val = $this->belongsTo(User::class, 'id', 'user_id')->first();
        return $val;
    }
}
