<?php

use App\Tuser;
use App\Tuser_user;
use Illuminate\Database\Seeder;

class TuserUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tuser_id = Tuser::where('name', 'Master')->first();
        $id_ = $tuser_id->id;
        Tuser_user::create([
        	'user_id' => 1,
        	'tuser_id' => $id_,
        ]);
        $tuser_id = Tuser::where('name', 'Administrador')->first();
        $id_ = $tuser_id->id;
        Tuser_user::create([
            'user_id' => 2,
            'tuser_id' => $id_,
        ]);
        $tuser_id = Tuser::where('name', 'Autor')->first();
        $id_ = $tuser_id->id;
        Tuser_user::create([
            'user_id' => 3,
            'tuser_id' => $id_,
        ]);
        $tuser_id = Tuser::where('name', 'Asesor')->first();
        $id_ = $tuser_id->id;
        Tuser_user::create([
            'user_id' => 4,
            'tuser_id' => $id_,
        ]);
    	for ($i=5; $i < 19; $i++) { 
	        Tuser_user::create([
	        	'user_id' => $i,
	        	'tuser_id' => rand(3,4),
	        ]);
    	}
    }
}
