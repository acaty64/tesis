<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuser_user extends Model
{
    protected $fillable = [
	        'tuser_id',
			'user_id',
    ];	
    protected $table = 'tuser_user';

    public function user()
    {
    	return $this->belongsTo(User::class, 'id');
    }

    public function tuser()
    {
    	return $this->belongsTo(Tuser::class, 'id');
    }

}
