<?php

use App\Sequence;
use Illuminate\Database\Seeder;

class SequencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Sequence::create([
    		'sequence' => 1.0,
    		'deal_id' => 1,
    		'next' => 2.0,
    	]);
    	Sequence::create([
    		'sequence' => 2.0,
    		'deal_id' => 2,
    		'next' => 3.0,
    	]);
    	Sequence::create([
    		'sequence' => 3.0,
    		'deal_id' => 3,
    		'next' => 4.0,
    	]);
    	Sequence::create([
    		'sequence' => 4.0,
    		'deal_id' => 4,
    		'next' => 5.0,
    		'fail' => 6.0
    	]);
    	Sequence::create([
    		'sequence' => 5.0,
    		'deal_id' => 5,
    		'next' => 7.0,
    	]);
    	Sequence::create([
    		'sequence' => 6.0,
    		'deal_id' => 6,
    		'next' => 2.0,
    	]);
    	Sequence::create([
    		'sequence' => 7.0,
    		'deal_id' => 7,
    		'next' => 8.0,
    	]);
    	Sequence::create([
    		'sequence' => 8.0,
    		'deal_id' => 8,
    		'next' => 9.0,
    	]);
    	Sequence::create([
    		'sequence' => 9.0,
    		'deal_id' => 9,
    		'next' => 10.0,
    		'fail' => 11.0
    	]);
    	Sequence::create([
    		'sequence' => 10.0,
    		'deal_id' => 10,
    		'next' => 13.0,
    	]);
    	Sequence::create([
    		'sequence' => 11.0,
    		'deal_id' => 11,
    		'next' => 12.0,
    	]);
    	Sequence::create([
    		'sequence' => 12.0,
    		'deal_id' => 12,
    		'next' => 7.0,
    	]);
    	Sequence::create([
    		'sequence' => 13.0,
    		'deal_id' => 13,
    		'next' => 14.0,
    	]);
    	Sequence::create([
    		'sequence' => 14.0,
    		'deal_id' => 14,
    		'next' => 15.0,
    		'fail' => 16.0
    	]);
    	Sequence::create([
    		'sequence' => 15.0,
    		'deal_id' => 15,
    		'next' => 0,
    	]);
    	Sequence::create([
    		'sequence' => 16.0,
    		'deal_id' => 16,
    		'next' => 17.0,
    	]);
    	Sequence::create([
    		'sequence' => 17.0,
    		'deal_id' => 17,
    		'next' => 11.0,
    	]);




    }
}
