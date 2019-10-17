<?php

use App\Tadvisor;
use Illuminate\Database\Seeder;

class TadvisorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tadvisor::create([
        	'name' => 'Asesor',
        ]);
        Tadvisor::create([
        	'name' => 'Revisor',
        ]);
        Tadvisor::create([
        	'name' => 'Comité',
        ]);
    }
}
