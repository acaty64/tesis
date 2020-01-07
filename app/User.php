<?php

namespace App;

use App\Acceso;
use App\Tuser_user;
use App\UserDetail;
use App\UserGrupo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // protected $connection = 'login';

    protected $appends = ['tuser', 'tuser_user', 'isMaster', 'isAdmin', 'isAdvisor', 'isDoc'];

    public function getIsMasterAttribute()
    {
        $tuser = $this->tuser;
        if($tuser == 'Master'){
            return true;
        }else{
            return false;
        }
    }

    public function getIsAdminAttribute()
    {
        $tuser = $this->tuser;
        if($tuser == 'Administrador'){
            return true;
        }else{
            return false;
        }
    }

    public function getIsAdvisorAttribute()
    {
        $tuser = $this->tuser;
        if($tuser == 'Asesor'){
            return true;
        }else{
            return false;
        }
    }

    public function getIsAuthorAttribute()
    {
        $tuser = $this->tuser;
        if($tuser == 'Autor'){
            return true;
        }else{
            return false;
        }
    }

    public function getTuserIdAttribute()
    {
        $val = $this->belongsTo(Tuser_user::class, 'id', 'user_id')->first();
        return $val->tuser->id;
    }

    public function getTuserAttribute()
    {
        $val = $this->belongsTo(Tuser_user::class, 'id', 'user_id')->first();
        return $val->tuser->name;
    }

    public function getTuserUserAttribute()
    {
        $val = $this->belongsTo(Tuser_user::class, 'id', 'user_id')->first();
        return $val;
    }

    public function getUserDetailAttribute()
    {
        $val = $this->belongsTo(UserDetail::class, 'id', 'user_id')->first();
        return $val;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cod_doc'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}
