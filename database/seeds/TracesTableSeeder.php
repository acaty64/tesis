<?php

use App\Trace;
use App\Tuser_user;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TracesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $authors = Tuser_user::where('tuser_id', 3)->get();
        $thesis_id = 1;
        foreach ($authors as $item) {
            Trace::create([
                'thesis_id' => $thesis_id++,
                'sequence_id' => 1,
                'date' => Carbon::today()->toDateTimeString(),
            ]);
        }




    }
}
