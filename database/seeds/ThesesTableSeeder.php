<?php

use App\Tuser_user;
use App\Thesis;
use Illuminate\Database\Seeder;

class ThesesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = Tuser_user::where('tuser_id', 3)->get();
    	foreach ($users as $item) {
	        Thesis::create([
	        	'serie' => rand(100, 150),
	        	'application' => rand(450, 600)
	        ]);
    	}
    }
}
