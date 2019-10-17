<?php

use App\Tuser;
use Illuminate\Database\Seeder;

class TusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
