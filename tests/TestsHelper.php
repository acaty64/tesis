<?php

namespace Tests;

use App\Tuser_user;
use App\User;
use App\UserAcceso;
use App\Tuser;

trait TestsHelper
{
    protected $defaultUser;
    // protected $defaultUserAcceso;

    public function defaultUser(array $attributes = [], $type)
    {
        $this->defaultUsers();
        switch ($type) {
            case 'Master':
                return User::findOrFail(1);
                break;
            case 'Admin':
                return User::findOrFail(2);
                break;
            case 'Autor':
                return User::findOrFail(3);
                break;
            case 'Asesor':
                return User::findOrFail(4);
                break;
            case 'Revisor':
                return User::findOrFail(5);
                break;
            case 'Comite':
                return User::findOrFail(6);
                break;
        }
    }

    protected function defaultUsers()
    {
        factory(User::class,6)->create();   
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

        Tuser_user::create([
            'user_id' => 5,
            'tuser_id' => 4,
        ]);
        Tuser_user::create([
            'user_id' => 6,
            'tuser_id' => 4,
        ]);
    }

    // public function defaultUser(array $attributes = [], $type)
    // {
    //     // if($this->defaultUser){
    //     //     return $this->defaultUser;
    //     // }
    //     return $this->defaultUser = $this->user($attributes, $type);
    //     // factory(User::class)->create($attributes);
    // }


    // private function user(array $attributes = [], $type)
    // {
    //     if($this->user){
    //         return $this->user;
    //     }

    //     $user  = factory(User::class)->create($attributes);
    //     $tuser_id = Tuser::where('name', $type)->first();
    //     Tuser_user::create([
    //         'user_id' => $user->id,
    //         'tuser_id' => $tuser_id
    //     ]);
    //     return $user;
    // }

    // public function defaultUser(array $attributes = [])
    // {
    //     return $this->defaultUser = factory(User::class)->create($attributes);
    // }

}
