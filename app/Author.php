<?php

namespace App;

use App\Thesis;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
        'thesis_id', 'user_id'
    ];

    public function user()
    {
		return $this->belongsTo(User::class, 'id');
    }
    public function thesis()
    {
		return $this->belongsTo(Thesis::class, 'id');
    }
}
