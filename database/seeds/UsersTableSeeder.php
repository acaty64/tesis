<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
    		'name' => 'Master',
    		'email' => 'master@example.net',
    		'password' => bcrypt('secret')
    	]);
    	User::create([
    		'name' => 'Administrador',
    		'email' => 'admin@example.net',
    		'password' => bcrypt('secret')
    	]);
    	User::create([
    		'name' => 'Autor',
    		'email' => 'autor@example.net',
    		'password' => bcrypt('secret')
    	]);
    	User::create([
    		'name' => 'Asesor',
    		'email' => 'asesor@example.net',
    		'password' => bcrypt('secret')
    	]);
		factory(User::class, 14)->create();
    }
}
