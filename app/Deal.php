<?php

namespace App;

use App\Temail;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'sequence_id', 'user_id', 'view', 'fdata', 'temail_id'
    ];

    public function getBladeAttribute()
    {
    	if(!is_null($this->temail_id)){
    		$temail = Temail::findOrFail($this->temail_id);
    		return $temail->blade;
    	}else{
    		return '';
    	}
    }
}
