<?php

use App\Tdeal;
use Illuminate\Database\Seeder;

class TdealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Tdeal::create([
			'name' => 'Ingreso de Información',
            'view' => true,
            'email' => true,
		]);
        Tdeal::create([
            'name' => 'Pregunta',
            'view' => true,
        ]);
		Tdeal::create([
			'name' => 'Carga de Archivo',
            'email' => true,
            'upload' => true,
            'download' => false,
		]);
        Tdeal::create([
            'name' => 'Descarga de Archivo',
            'email' => false,
            'upload' => false,
            'download' => true,
        ]);
    }
}
