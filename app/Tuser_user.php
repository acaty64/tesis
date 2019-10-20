<?php

namespace App;

use App\Tuser;
use Illuminate\Database\Eloquent\Model;

class Tuser_user extends Model
{
    protected $fillable = [
	        'tuser_id',
			'user_id',
    ];	
    protected $table = 'tuser_user';

    protected $appends = ['tuser', 'user'];


    public function getTuserAttribute()
    {
        $val = $this->belongsTo(Tuser::class, 'tuser_id', 'id')->first();
        return $val;
    }

    public function getUserAttribute()
    {
        $val = $this->belongsTo(User::class, 'user_id', 'id')->first();
        return $val;
    }
    // public function user()
    // {
    // 	return $this->belongsTo(User::class, 'id');
    // }

    // public function tuser()
    // {
    // 	return $this->belongsTo(Tuser::class, 'id');
    // }

}
