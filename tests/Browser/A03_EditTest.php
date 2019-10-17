<?php

namespace Tests\Browser;

use App\Acceso;
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

class A03_EditTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * An Edit test with ERRORS.
     *
     * @return void
     */
    public function testEdit()
    {
        $this->artisan('db:seed');
        $this->artisan('cache:clear');

        // SUMILLAS
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'master',
                    'user_id' => $user->id
                ]);

        $this->browse(function (Browser $browser) use ($user) {
            $selector = '.id1.sumillas';
            $texto = 'El curso tiene como propósito';
            $error = 'Inserte el texto SUMILLA.';
            $browser->loginAs($user)
                    ->visit(route('syllabus.show',['semestre'=>'20191','cod_curso'=>'100048','edit'=>true]))
                    ->waitFor('.SyllabusComponent', 20)
                    ->waitFor('.Vista', 20)
                    ->waitForText('Sumillas', 20)
                    ->press('Sumillas')
                    ->assertSee('II. SUMILLA')
                    ->assertSee($texto)
                    ->click('.btnEdit1')
                    ->waitFor($selector)
                    ->type($selector, ' ')
                    ->waitFor('.btnSave1')
                    ->click('.btnSave1')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11);
        });
        // End SUMILLAS

        // COMPETENCIAS
/*
        $this->browse(function (Browser $browser) {
            $browser->visit('/show/20191/100048')
                    ->waitFor('.SyllabusComponent', 20)
                    ->waitFor('.Vista', 20)
                    ->waitForText('Competencias')
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
*/
        // End COMPETENCIAS

        // UNIDADES
        $this->browse(function (Browser $browser) {
            $browser->press('Unidades')
                    ->assertSee('UNIDADES')
                    ->assertSee('LA CONTABILIDAD GERENCIAL.')
                    ->click('.btnEdit2');

            $selector = '.id2.col-1';
            $texto = $browser->text($selector);
            $error = 'La SEMANA debe ser un número entero mayor que 0 y menor a 17.';
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id2.col-2';
            $error = 'Inserte el texto UNIDAD.';
            $texto = $browser->text($selector);
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto);
            $browser->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id2.col-3';
            $error = 'Inserte el texto LOGRO.';
            $texto = $browser->text($selector);
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

        });
        // End UNIDADES

        // CONTENIDOS
        $this->browse(function (Browser $browser) {
            $browser->press('Contenidos')
                    ->assertSee('CONTENIDOS')
                    ->assertSee('La contabilidad gerencial.')
                    ->click('.btnEdit3');

            $selector = '.id3.col-1';
            $texto = $browser->text($selector);
            $error = 'La SEMANA debe ser un número entero mayor que 0 y menor a 17.';
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave3')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id3.col-2';
            $error = 'Inserte el texto CONCEPTUAL.';
            $texto = $browser->text($selector);
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->waitFor('.btnSave3')
                    ->click('.btnSave3')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id3.col-4';
            $error = 'Inserte el texto PROCEDIMENTAL.';
            $texto = $browser->text($selector);
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave3')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id3.col-6';
            $error = 'Inserte el texto ACTIVIDAD.';
            $texto = $browser->text($selector);
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave3')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

        });

        // ESTRATEGIAS
        $this->browse(function (Browser $browser) {
            $browser->press('Estrategias')
                    ->assertSee('V. ESTRATEGIAS METODOLÓGICAS')
                    ->assertSee('Lecturas');
//                    ->click('.btnEdit3');

            $selector = '.estrategias';
            $texto = $browser->text($selector);
            $error = 'Inserte el texto ESTRATEGIAS.';
            $browser->press('.btnEdit1')
                    ->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave1')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

        });
        // End ESTRATEGIAS


        // EVALUACIONES
        $this->browse(function (Browser $browser) {
            $browser->press('Evaluaciones')
                    ->assertSee('EVALUACIÓN')
                    ->click('.btnEdit2');

            $selector = '.id2.col-1';
            $texto = $browser->text($selector);
            $error = 'Inserte el texto EVALUACION.';
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id2.col-2';
            $texto = $browser->text($selector);
            $error = 'El PORCENTAJE debe ser un número entero mayor a 0';
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id2.col-3';
            $texto = $browser->text($selector);
            $error = 'La SEMANA debe ser un número entero menor a 17.';
            $browser->type($selector, '17')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

        });
        // End EVALUACIONES

        // BIBLIOGRAFIA
        $this->browse(function (Browser $browser) {
            $browser->press('Bibliografias')
                    ->assertSee('VII. BIBLIOGRAFÍA')
                    ->assertSee('Autor(es)')
                    ->click('.btnEdit2');

            $selector = '.id2.col-1';
            $texto = $browser->text($selector);
            $error = 'Inserte el texto AUTOR(ES).';
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error, 10)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id2.col-2';
            $texto = $browser->text($selector);
            $error = 'Inserte el texto TÍTULO.';
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id2.col-3';
            $texto = $browser->text($selector);
            $error = 'Inserte el texto EDITORIAL.';
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            $selector = '.id2.col-4';
            $texto = '2016';
            $error = 'El AÑO debe ser un número entero mayor a 1900.';
            $browser->type($selector, ' ')
                    ->assertDontSeeIn($selector, $texto)
                    ->click('.btnSave2')
                    ->waitForText($error)
                    ->waitUntilMissing('.toast', 11)
                    ->type($selector, $texto)
                    ->assertSeeIn($selector, $texto);

            // $selector = '.id2.col-5';
            // $texto = $browser->text($selector);
            // $error = 'Inserte el texto UBICACIÓN.';
            // $browser->type($selector, ' ')
            //         ->assertDontSeeIn($selector, $texto)
            //         ->click('.btnSave2')
            //         ->waitForText($error)
            //         ->waitUntilMissing('.toast', 11)
            //         ->type($selector, $texto)
            //         ->assertSeeIn($selector, $texto);

        });

        // End BIBLIOGRAFIA

    }

}
