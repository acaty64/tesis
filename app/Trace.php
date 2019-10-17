<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trace extends Model
{
    protected $fillable = [
        'thesis_id', 'sequence_id', 'date', 'document', 'file'
    ];

}
