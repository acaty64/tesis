<?php

use App\User;
use App\UserDetail;
use Illuminate\Database\Seeder;

class UserDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$users = User::all();
		foreach($users as $user){
			UserDetail::create([
				'user_id' => $user->id,
				'fono' => str_random(9),
				'codigo' => str_random(9)
			]);
		}
    }
}
