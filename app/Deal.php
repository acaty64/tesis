<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'sequence_id', 'user_id', 'blade', 'email_id'
    ];

}
