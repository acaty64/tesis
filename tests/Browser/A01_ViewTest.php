<?php

namespace Tests\Browser;

use App\Acceso;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class A01_ViewTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testView()
    {
        $this->artisan('db:seed');

//        Artisan::call('db:seed', ['--class' => 'AccesoTableSeeder', '--database' => 'mysql_tests']);
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'master',
                    'user_id' => $user->id
                ]);
/*
        $user = $this->defaultUser();
        $acceso_id = Acceso::where('cod_acceso', 'master')->first()->id;

        $userAcceso = $this->defaultUserAcceso([
                'user_id' => $user->id,
                'acceso_id' => $acceso_id 
            ]);
*/
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit(route('syllabus.show',['semestre'=>env("SEMESTRE"),'cod_curso'=>'100048','edit'=>true]))
                    ->waitFor('.SyllabusComponent', 20)
                    ->waitFor('.Vista', 20)
                    ->waitForText('I. DATOS GENERALES', 20)
                    ->assertSee('I. DATOS GENERALES')
                    ->press('Generalidades')
                    ->assertSee('I. DATOS GENERALES')
                    ->press('Sumillas')
                    ->assertSee('II. SUMILLA')
                    ->press('Competencias')
                    ->assertSee('III. SISTEMA DE COMPETENCIAS')
                    ->press('Unidades')
                    ->assertSee('UNIDADES')
                    ->press('Contenidos')
                    ->assertSee('IV. PROGRAMACIÓN DE CONTENIDOS')
                    ->press('Estrategias')
                    ->assertSee('V. ESTRATEGIAS METODOLÓGICAS')
                    ->press('Evaluaciones')
                    ->assertSee('VI. EVALUACIONES')
                    ->press('Bibliografias')
                    ->assertSee('VII. BIBLIOGRAFÍA')
                    ;
        });
    }
}
