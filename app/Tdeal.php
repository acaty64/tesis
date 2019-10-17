<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tdeal extends Model
{
    protected $fillable = [
        'name', 'blade', 'email', 'upload', 'download'
    ];

}
