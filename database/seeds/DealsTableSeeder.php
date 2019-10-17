<?php

use App\Deal;
use Illuminate\Database\Seeder;

class DealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id = 1
		Deal::create([
			'name' => 'Ingreso de Datos para acceso al módulo',
            'tdeal_id' => 1,
            'tuser_id' => 2,
            'blade' => 'app.document.author',
            'email_id' => 1,
		]);
        // id = 2
		Deal::create([
			'name' => 'Carga de Plan de Tesis',
            'tdeal_id' => 3,
            'tuser_id' => 3,
            'blade' => 'app.document.up10',
            'email_id' => 2,
		]);
        Deal::create([
            'name' => 'Descarga de Plan de Tesis',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'blade' => 'app.document.down10',
        ]);
        // id = 4
        Deal::create([
            'name' => 'Decisión Plan de Tesis',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'blade' => 'app.document.ask1',
        ]);
        // id = 5
		Deal::create([
			'name' => 'Plan de Tesis Aprobado',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'email_id' => 3
		]);
        // id = 6
        Deal::create([
            'name' => 'Plan de Tesis Desaprobado',
            'tdeal_id' => 3,
            'tuser_id' => 4,
            'email_id' => 4
        ]);
        // id = 7
		Deal::create([
			'name' => 'Carga de Avance',
            'tdeal_id' => 3,
            'tuser_id' => 3,
            'blade' => 'app.document.up10',
            'email_id' => 5
		]);
        // id = 8
		Deal::create([
			'name' => 'Descarga de Avance',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'blade' => 'app.document.down10',
		]);
        // id = 9
        Deal::create([
            'name' => 'Decisión sobre el Avance',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'blade' => 'app.document.ask2',
        ]);
        // id = 10
        Deal::create([
            'name' => 'Avance de Tesis Aprobada',
            'tdeal_id' => 1,
            'tuser_id' => 4,
            'email_id' => 6
        ]);
        // id = 11
        Deal::create([
            'name' => 'Observaciones al Avance de Tesis',
            'tdeal_id' => 3,
            'tuser_id' => 4,
            'email_id' => 7
        ]);
        // id = 12
        Deal::create([
            'name' => 'Descarga de Observaciones al Avance',
            'tdeal_id' => 4,
            'tuser_id' => 2,
            'blade' => 'app.document.down10',
        ]);
        // id = 13
        Deal::create([
            'name' => 'Descarga del Revisor',
            'tdeal_id' => 4,
            'tuser_id' => 5,
            'blade' => 'app.document.down20',
        ]);
        // id = 14
        Deal::create([
            'name' => 'Decisión del Revisor',
            'tdeal_id' => 2,
            'tuser_id' => 5,
            'blade' => 'app.document.ask2',
        ]);
        // id = 15
        Deal::create([
            'name' => 'Tesis Aprobada',
            'tdeal_id' => 1,
            'tuser_id' => 5,
            'email_id' => 8
        ]);
        // id = 16
        Deal::create([
            'name' => 'Observaciones del Revisor',
            'tdeal_id' => 3,
            'tuser_id' => 5,
            'email_id' => 9
        ]);
        // id = 17
        Deal::create([
            'name' => 'Descarga de Observaciones del Revisor',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'blade' => 'app.document.down20',
        ]);
    }
}
