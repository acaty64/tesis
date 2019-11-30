<?php

use App\Title;
use App\Tuser_user;
use Illuminate\Database\Seeder;

class TitlesTableSeeder extends Seeder
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
            Title::create([
                'title' => 'Estudio preliminar de prueba '.$thesis_id,
                'thesis_id' => $thesis_id++,
            ]);
        }




    }
}
