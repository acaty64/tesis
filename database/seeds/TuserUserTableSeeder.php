<?php

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
        Tuser_user::create([
        	'user_id' => 1,
        	'tuser_id' => 1,
        ]);
    	for ($i=2; $i < 16; $i++) { 
	        Tuser_user::create([
	        	'user_id' => $i,
	        	'tuser_id' => rand(2,4),
	        ]);
    	}
    }
}
