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
    		'name' => 'Asesor1',
    		'email' => 'asesor1@example.net',
    		'password' => bcrypt('secret')
    	]);
        User::create([
            'name' => 'Asesor2',
            'email' => 'asesor2@example.net',
            'password' => bcrypt('secret')
        ]);
        User::create([
            'name' => 'Comite',
            'email' => 'comite@example.net',
            'password' => bcrypt('secret')
        ]);
		factory(User::class, 10)->create();
    }
}
