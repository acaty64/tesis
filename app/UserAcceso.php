<?php

namespace App;

use App\Acceso;
use Illuminate\Database\Eloquent\Model;

class UserAcceso extends Model
{
	protected $fillable = [
        'user_id', 'acceso_id',
    ];

	protected $appends = ['acceso'];
    
    public function getAccesoAttribute()
    {
        //$val = Acceso::where('id', $this->acceso_id)->first();
        $val = $this->belongsTo(Acceso::class, 'acceso_id', 'id')->first();
        return $val;
    }
    public function getUserAttribute()
    {
        //$val = Acceso::where('id', $this->acceso_id)->first();
        $val = $this->belongsTo(User::class, 'user_id', 'id')->first();
        return $val;
    }
}
