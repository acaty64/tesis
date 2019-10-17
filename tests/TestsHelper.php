<?php

namespace Tests;

use App\Acceso;
use App\User;
use App\UserAcceso;
//use Illuminate\Support\Facades\Session;

//use Illuminate\Contracts\Console\Kernel;

trait TestsHelper
{
    protected $defaultUser;
    protected $defaultUserAcceso;
//    protected $authUser;

    public function defaultUser(array $attributes = [])
    {
        return $this->defaultUser = factory(User::class)->create($attributes);
    }

    public function defaultUserAcceso(array $attributes = [])
    {
//dd('defaultUserAcceso', $attributes);
        Acceso::create([
                'cod_acceso' => 'master',
                'wacceso' => 'Master',
            ]);
        Acceso::create([
                'cod_acceso' => 'adm',
                'wacceso' => 'Administrador',
            ]);
        Acceso::create([
                'cod_acceso' => 'resp',
                'wacceso' => 'Responsable',
            ]);
        Acceso::create([
                'cod_acceso' => 'doc',
                'wacceso' => 'Docente',
            ]);
        $acceso_id = Acceso::where('cod_acceso', $attributes['cod_acceso'])->first()->id;
        $UserAccesoAttributes = [
                    'user_id' => $attributes['user_id'],
                    'acceso_id' => $acceso_id
                ];
        return $this->defaultUserAcceso = UserAcceso::create($UserAccesoAttributes);
    }
}
