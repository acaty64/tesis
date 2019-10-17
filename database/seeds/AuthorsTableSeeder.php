<?php

use App\Tuser_user;
use App\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$authors = Tuser_user::where('tuser_id', 3)->get();
    	$thesis_id = 0;
    	foreach ($authors as $item) {
	        Author::create([
	        	'thesis_id' => $thesis_id++,
	        	'user_id' => $item->id 
	        ]);
    	}
    }
}
