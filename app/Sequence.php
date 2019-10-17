<?php

namespace App;

use App\Deal;
use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected $fillable = [
        'sequence', 'deal_id', 'years', 'months', 'days', 'next', 'fail'
    ];
    protected $appends = ['name', 'blade'];

    public function getNameAttribute()
    {
    	$name = Deal::findOrFail($this->deal_id)->name;
    	return $name;
    }
    public function getBladeAttribute()
    {
    	$blade = Deal::findOrFail($this->deal_id)->blade;
    	return $blade;
    }

}
