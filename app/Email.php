<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'deal_id', 'date', 'from_user_id', 'to_user1_id', 'to_user2_id', 'to_user3_id'
    ];

}
