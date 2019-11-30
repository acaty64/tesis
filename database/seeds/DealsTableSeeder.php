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
            'view' => 'app.document.author',
            'fdata' => 'dataAuthorBlade',
            'temail_id' => 1,
		]);
        // id = 2
		Deal::create([
			'name' => 'Carga de Plan de Tesis',
            'tdeal_id' => 3,
            'tuser_id' => 3,
            'view' => 'app.document.up10',
            'fdata' => 'dataUp10Blade',
            'temail_id' => 2,
		]);
        Deal::create([
            'name' => 'Descarga de Plan de Tesis',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'tadvisor_id' => 3,
            'view' => 'app.document.down10',
            'fdata' => 'dataDown10Blade',
        ]);
        // id = 4
        Deal::create([
            'name' => 'Decisión Plan de Tesis',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'tadvisor_id' => 3,
            'view' => 'app.document.ask1',
            'fdata' => 'dataAsk1Blade',
        ]);
        // id = 5
		Deal::create([
			'name' => 'Plan de Tesis Aprobado',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'tadvisor_id' => 3,
            'temail_id' => 3
		]);
        // id = 6
        Deal::create([
            'name' => 'Plan de Tesis Desaprobado',
            'tdeal_id' => 3,
            'tuser_id' => 4,
            'tadvisor_id' => 3,
            'temail_id' => 4
        ]);
        // id = 7
		Deal::create([
			'name' => 'Carga de Avance',
            'tdeal_id' => 3,
            'tuser_id' => 3,
            'view' => 'app.document.up10',
            'fdata' => 'dataUp10Blade',
            'temail_id' => 5
		]);
        // id = 8
		Deal::create([
			'name' => 'Descarga de Avance',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'tadvisor_id' => 1,
            'view' => 'app.document.down10',
            'fdata' => 'dataDown10Blade',
		]);
        // id = 9
        Deal::create([
            'name' => 'Decisión sobre el Avance',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'tadvisor_id' => 1,
            'view' => 'app.document.ask2',
            'fdata' => 'dataAsk2Blade',
        ]);
        // id = 10
        Deal::create([
            'name' => 'Avance de Tesis Aprobada',
            'tdeal_id' => 1,
            'tuser_id' => 4,
            'tadvisor_id' => 1,
            'temail_id' => 6
        ]);
        // id = 11
        Deal::create([
            'name' => 'Observaciones al Avance de Tesis',
            'tdeal_id' => 3,
            'tuser_id' => 4,
            'tadvisor_id' => 1,
            'temail_id' => 7
        ]);
        // id = 12
        Deal::create([
            'name' => 'Descarga de Observaciones al Avance',
            'tdeal_id' => 4,
            'tuser_id' => 2,
            'view' => 'app.document.down10',
            'fdata' => 'dataDown10Blade',
        ]);
        // id = 13
        Deal::create([
            'name' => 'Descarga del Revisor',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'tadvisor_id' => 2,
            'view' => 'app.document.down20',
            'fdata' => 'dataDown20Blade',
        ]);
        // id = 14
        Deal::create([
            'name' => 'Decisión del Revisor',
            'tdeal_id' => 2,
            'tuser_id' => 4,
            'tadvisor_id' => 2,
            'view' => 'app.document.ask2',
            'fdata' => 'dataAsk2Blade',
        ]);
        // id = 15
        Deal::create([
            'name' => 'Tesis Aprobada',
            'tdeal_id' => 1,
            'tuser_id' => 4,
            'tadvisor_id' => 2,
            'temail_id' => 8
        ]);
        // id = 16
        Deal::create([
            'name' => 'Observaciones del Revisor',
            'tdeal_id' => 3,
            'tuser_id' => 4,
            'tadvisor_id' => 2,
            'temail_id' => 9
        ]);
        // id = 17
        Deal::create([
            'name' => 'Descarga de Observaciones del Revisor',
            'tdeal_id' => 4,
            'tuser_id' => 4,
            'view' => 'app.document.down20',
            'fdata' => 'dataDown20Blade',
        ]);
    }
}
