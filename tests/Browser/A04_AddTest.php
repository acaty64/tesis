<?php

namespace Tests\Browser;

use App\Acceso;
use App\Estrategia;
use App\Sumilla;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskData;
use Tests\DuskTestCase;

    /**
     * 1. Sumillas Ok
     * 2. Unidades Ok
     * 3. Competencias ---- REVISAR
     * 4. Contenidos Ok
     * 5. Estrategias Ok
     * 6. Evaluaciones Ok
     * 7. Bibliografias Ok
     */

class A04_AddTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * An ADD test.
     *
     * @return void
     */
    public function testAdd()
    {
        $this->artisan('db:seed');
        $this->artisan('cache:clear');

        $id = 1;
        $sumillas = Sumilla::where('cod_curso','100048')->get();
        foreach ($sumillas as $sumilla) {
            $sumilla->delete();
        }
        // SUMILLAS
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'master',
                    'user_id' => $user->id
                ]);

        $this->browse(function (Browser $browser) use ($user) {
                    
            $selector = '.col-1.sumillas';
            $texto = 'El curso tiene como proposito ...';
            $mess = 'Sumilla grabada.';
            $browser->loginAs($user)
                    ->visit(route('syllabus.show',['semestre'=>'20191','cod_curso'=>'100048','edit'=>true]))
                    ->waitFor('.SyllabusComponent', 20)
                    ->waitFor('.Vista', 20)
                    ->waitForText('Sumillas', 20)
                    ->press('Sumillas')
                    ->assertSee('II. SUMILLA')
                    ->waitFor('.btnEditarnew')
                    ->press('Nuevo Registro')
                    ->waitFor($selector, 20)
                    ->type($selector, $texto)
                    ->waitFor('.btnGrabarnew')
                    ->press('Grabar')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->waitForText($texto);

                $this->assertDatabaseHas('sumillas', [
                        'plan' => '8',
                        'cod_curso' => '100048',
                        'texto' => $texto
                    ]);
        });

        // End SUMILLAS

/*
        // COMPETENCIAS
        $this->browse(function (Browser $browser) {
            $browser->visit('/show/20191/100048')
                    ->waitFor('.SyllabusComponent', 20)
                    ->waitFor('.Vista', 20)
                    ->press('Competencias')
                    ->assertSee('III. SISTEMA DE COMPETENCIAS')
                    ->assertSee('COMPETENCIAS GENERALES')
                    ->click('.btnEdit6');

            $selector = '.id6.col-2';
            $error = 'Inserte el texto.';
            $texto = $browser->text($selector);
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto);
            $browser->click('.btnSave6')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

        });
        // End COMPETENCIAS
*/
        // UNIDADES
        $this->browse(function (Browser $browser) {
            $browser->press('Unidades')
                    ->assertSee('UNIDADES')
                    ->assertSee('LA CONTABILIDAD GERENCIAL.')
                    ->click('.btnEditarnew');

            $selector = '.idnew.col-1';
            $mess = 'Unidad grabada.';
            $browser->type('.idnew.col-1', 1)
                    ->type('.idnew.col-2', 'Nuevo texto UNIDAD.')
                    ->type('.idnew.col-3', 'Nuevo texto LOGRO.')
                    ->click('.btnGrabarnew')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 1000);');

            $browser->waitForText('NUEVO TEXTO UNIDAD.')
                    ->waitForText('Nuevo texto LOGRO.');

                $this->assertDatabaseHas('unidades', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'texto' => 'NUEVO TEXTO UNIDAD.',
                        'logro' => 'Nuevo texto LOGRO.'
                    ]);
        });
        // End UNIDADES

        // CONTENIDOS

        $this->artisan('cache:clear');
        $this->browse(function (Browser $browser) {
            $browser->press('Contenidos')
                    ->assertSee('CONTENIDOS')
                    ->assertSee('La contabilidad gerencial.')
                    ->waitFor('.btnEditarnew', 20)
                    ->click('.btnEditarnew');

            $selector = '.idnew.col-1';
            $texto = 'Contenido grabado.';
            $browser->type('.idnew.col-1', 5)
                    ->type('.idnew.col-2', 'Nuevo Concepto')
                    ->type('.idnew.col-4', 'Nuevo Procedimiento')
                    ->type('.idnew.col-6', 'Nueva Actividad')
                    ->click('.btnGrabarnew')
                    ->waitForText($texto)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 1500);');

            $browser->waitForText('NUEVO TEXTO UNIDAD.')
                    ->waitForText('Nuevo Concepto')
                    ->waitForText('Nuevo Procedimiento')
                    ->waitForText('Nueva Actividad');

            // Segundo concepto
            $browser->script('window.scrollTo(0, 0);');
            $browser->press('Contenidos')
                    ->waitFor('.btnEditarnew', 20)
                    ->click('.btnEditarnew')
                    ->type('.idnew.col-1', 6)
                    ->type('.idnew.col-2', 'Nuevo Concepto 6')
                    ->type('.idnew.col-4', 'Nuevo Procedimiento 6')
                    ->type('.idnew.col-6', 'Nueva Actividad 6')
                    ->click('.btnGrabarnew')
                    ->waitForText($texto)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 1500);');

            $browser->waitForText('NUEVO TEXTO UNIDAD.')
                    ->waitForText('Nuevo Concepto 6')
                    ->waitForText('Nuevo Procedimiento 6')
                    ->waitForText('Nueva Actividad 6');

            $this->assertDatabaseHas('contenidos', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'concepto' => 'Nuevo Concepto',
                        'procedimiento' => 'Nuevo Procedimiento',
                        'actividad' => 'Nueva Actividad',
                        'semana' => 5,
                    ]);

            $this->assertDatabaseHas('contenidos', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'concepto' => 'Nuevo Concepto 6',
                        'procedimiento' => 'Nuevo Procedimiento 6',
                        'actividad' => 'Nueva Actividad 6',
                        'semana' => 6,
                    ]);
        });

        // ESTRATEGIAS
        $id = 1;
        $estrategia = Estrategia::truncate();

        $this->artisan('cache:clear');
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit(route('syllabus.show',['semestre'=>'20191','cod_curso'=>'100048','edit'=>true]))
                    ->waitFor('.SyllabusComponent', 20)
                    ->waitFor('.Vista', 20)
                    ->waitForText('Estrategias', 20)
                    ->press('Estrategias')
                    ->assertSee('V. ESTRATEGIAS METODOLÓGICAS')
                    ->waitFor('.btnEditarnew', 20)
                    ->click('.btnEditarnew');

            $selector = '.estrategias';
            $texto = 'Nueva estrategia';
            $mess = 'Estrategias grabadas.';
            $browser->type($selector, $texto)
                    ->assertSeeIn($selector, $texto)
                    ->click('.btnGrabarnew')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 2000);');

            $browser->waitForText($texto)
                    ->script('window.scrollTo(0, 0);');

            $browser->assertDontSee('Nuevo Registro');

            $this->assertDatabaseHas('estrategias', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'texto' => 'Nueva estrategia',
                    ]);        
        });
        // End ESTRATEGIAS

        // EVALUACIONES
        $this->browse(function (Browser $browser) {
            $browser->press('Evaluaciones')
                    ->assertSee('EVALUACIONES')
                    ->click('.btnEditarnew');

            $browser
                    ->type('.idnew.col-1', 'Nueva evaluacion')
                    ->type('.idnew.col-2', 10)
                    ->type('.idnew.col-3', 3)
                    ->click('.btnGrabarnew')
                    ->waitForText('Evaluacion grabada.')
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 2000);');


            $this->assertDatabaseHas('evaluaciones', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'texto' => 'Nueva evaluacion',
                        'porcentaje' => '10',
                        'semana' => '3',
                    ]);        
        });
        // End EVALUACIONES

        // BIBLIOGRAFIA
        $this->browse(function (Browser $browser) {
            $browser->press('Bibliografias')
                    ->assertSee('VII. BIBLIOGRAFÍA')
                    ->assertSee('Autor(es)')
                    ->click('.btnEditarnew');

            $browser
                    ->type('.idnew.col-1', 'Nuevo autor')
                    ->type('.idnew.col-2', 'Nuevo titulo')
                    ->type('.idnew.col-3', 'Nuevo editorial')
                    ->type('.idnew.col-4', '2016')
                    ->type('.idnew.col-5', 'UCSSxxx')
                    ->click('.btnGrabarnew')
                    ->waitForText('Bibliografía grabada.')
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 2500);');

            $browser->waitForText('Nuevo autor');

            $this->assertDatabaseHas('bibliografias', [
                        "cod_curso"=> "100048",
                        "semestre"=>"20191",
                        "autor" => "Nuevo autor",
                        "titulo" => "Nuevo titulo",
                        "editorial" => "Nuevo editorial",
                        "year" => "2016",
                        "codigo" => "UCSSxxx",
                    ]);

        });

        // End BIBLIOGRAFIA

    }
}
