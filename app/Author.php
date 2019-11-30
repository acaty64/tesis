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

    public function getNameAttribute()
    {
        $user = User::findOrFail($this->user_id);
        return $user->name;
    }
    public function thesis()
    {
		return $this->belongsTo(Thesis::class, 'id');
    }
}
