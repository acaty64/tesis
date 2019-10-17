<?php

namespace App;

use App\Advisor_type;
use App\Thesis;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    protected $fillable = [
        'thesis_id', 'user_id', 'advisor_type_id',
    ];

    public function user()
    {
		return $this->belongsTo(User::class, 'id');
    }
    public function thesis()
    {
		return $this->belongsTo(Thesis::class, 'id');
    }
    public function advisor_type()
    {
		return $this->belongsTo(Advisor_type::class, 'id');
    }


}
