<?php

namespace App;

use App\Tadvisor;
use App\Thesis;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    protected $fillable = [
        'thesis_id', 'user_id', 'tadvisor_id',
    ];
    
    protected $appends = ['tadvisor_name'];

    public function user()
    {
		return $this->belongsTo(User::class, 'id');
    }
    public function thesis()
    {
		return $this->belongsTo(Thesis::class, 'id');
    }
    public function getTadvisorNameAttribute()
    {
        $t = Tadvisor::findOrFail($this->tadvisor_id);
        return $t->name;
		// return $this->belongsTo(Tadvisor::class, 'advisor_type_id');
    }


}
