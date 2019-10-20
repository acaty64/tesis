<?php

namespace Tests;

use App\Tuser_user;
use App\User;
use App\UserAcceso;
use App\Tuser;

trait TestsHelper
{
    protected $defaultUser;
    protected $defaultUserAcceso;

    public function defaultUser(array $attributes = [])
    {
        return $this->defaultUser = factory(User::class)->create($attributes);
    }

    public function defaultUsers()
    {
        factory(User::class,4)->create();   
        Tuser::create([
            'name'=>'Master'
        ]);
        Tuser::create([
            'name'=>'Administrador'
        ]);
        Tuser::create([
            'name'=>'Autor'
        ]);
        Tuser::create([
            'name'=>'Asesor'
        ]);
        $n = 1; 
        for ($i=4; $i > 0; $i--) {
            Tuser_user::create([
                'user_id' => $n++,
                'tuser_id' => $i,
            ]);
        }
        // $users = User::all();
        // return $users;
    }


}
