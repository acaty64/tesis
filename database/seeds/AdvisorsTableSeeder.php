<?php

use App\Tuser_user;
use App\Advisor;
use App\Thesis;
use Illuminate\Database\Seeder;

class AdvisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$theses = Thesis::all();
        foreach ($theses as $thesis) {
        	$thesis_id = $thesis->id;
        	$users = Tuser_user::where('tuser_id',4)->get();
        	$qusers = $users->count();
        	for ($i=0; $i<3; $i++) { 
        		$user_id = $users[rand(0,$qusers-1)]['user_id'];
        		Advisor::create([
        			'thesis_id' => $thesis_id,
        			'user_id' => $user_id,
        			'tadvisor_id' => $i+1
        		]);
        	}
        }
    }
}
