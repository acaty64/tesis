<?php

namespace Tests\Browser;

use App\Acceso;
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

class A05_EraseTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * An ERASE test.
     *
     * @return void
     */
    public function testDelete()
    {
        $this->artisan('db:seed');
        $this->artisan('cache:clear');

        $id = 1;
        // SUMILLAS
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'master',
                    'user_id' => $user->id
                ]);

        $this->browse(function (Browser $browser) use ($user) {
                    
            $selector = '.col-1.sumillas';
            $texto = 'El curso tiene como ';
            $mess = 'Sumilla eliminada.';
            $browser->loginAs($user)
                    ->visit(route('syllabus.show',['semestre'=>'20191','cod_curso'=>'100048','edit'=>true]))
                    ->waitFor('.SyllabusComponent', 20)
                    ->waitFor('.Vista', 20)
                    ->waitForText('Sumillas', 10)
                    ->press('Sumillas')
                    ->assertSee('II. SUMILLA')
                    ->waitFor('.btnEdit1')
                    ->waitFor('.btnErase1')
                    ->press('.btnErase1')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->assertDontSee($texto);

                $this->assertDatabaseMissing('sumillas', [
                        'plan' => '8',
                        'cod_curso' => '100048',
                        'texto' => $texto
                    ]);
        });
        // End SUMILLAS
    
        // CONTENIDOS
        $this->browse(function (Browser $browser) {
            $selector = '.id1.col-1.contenidos';
            $texto = 'Reconoce el recorrido de las operaciones';
            $mess = 'Contenido eliminado.';
            $browser->press('Contenidos')
                    ->assertSee('IV. PROGRAMACIÓN DE CONTENIDOS')
                    ->waitFor('.btnEdit1')
                    ->waitFor('.btnErase1')
                    ->press('.btnErase1')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 1000);');

            $browser->assertDontSee($texto);

                $this->assertDatabaseMissing('contenidos', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'procedimiento' => $texto
                    ]);
        });
        // End CONTENIDOS


        // UNIDADES
        $this->browse(function (Browser $browser) {
            $selector = '.id1.col-1.unidades';
            $texto = 'ANALISIS E INTERPRETACION DE LOS ESTADOS FINANCIEROS.';
            $mess = 'Unidad eliminada.';
            $browser->press('Unidades')
                    ->assertSee('UNIDADES')
                    ->waitFor('.btnEdit2');
                    //->driver->takeScreenshot(base_path('tests/Browser/screenshots/check.png'));

            $browser->waitFor('.btnErase2')
                    ->press('.btnErase2')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 1000);');

            $browser->assertDontSee($texto);

                $this->assertDatabaseMissing('unidades', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'texto' => $texto
                    ]);
        });

        // End UNIDADES


/*
        // COMPETENCIAS

        // End COMPETENCIAS

*/
        // ESTRATEGIAS
        $this->browse(function (Browser $browser) {
            $selector = '.col-1.estrategias';
            $texto = 'El curso tiene como ';
            $mess = 'Estrategias eliminadas.';
            $browser->press('Estrategias')
                    ->assertSee('V. ESTRATEGIAS METODOLÓGICAS')
                    ->waitFor('.btnEdit1')
                    ->waitFor('.btnErase1')
                    ->press('.btnErase1')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 2000);');

            $browser->assertSee('V. ESTRATEGIAS METODOLÓGICAS')
                    ->assertDontSee($texto);

                $this->assertDatabaseMissing('estrategias', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'texto' => $texto
                    ]);
        });
        // End ESTRATEGIAS


        // EVALUACIONES
        $this->browse(function (Browser $browser) {
            $selector = '.col-1.evaluacion';
            $texto = 'Primer Examen Parcial';
            $mess = 'Evaluacion eliminada.';
            $browser->press('Evaluaciones')
                    ->assertSee('VI. EVALUACIONES')
                    ->waitFor('.btnEdit1')
                    ->waitFor('.btnErase1')
                    ->press('.btnErase1')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 1000);');

            $browser->assertSee('VI. EVALUACIONES')
                    ->assertDontSee($texto);

                $this->assertDatabaseMissing('estrategias', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'texto' => $texto
                    ]);
        });
        // End EVALUACIONES


        // BIBLIOGRAFIA
        $this->browse(function (Browser $browser) {
            $selector = '.col-1.bibliografias';
            $mess = 'Bibliografía eliminada.';
            $browser->press('Bibliografias')
                    ->assertSee('VII. BIBLIOGRAFÍA')
                    ->waitFor('.btnEdit1')
                    ->waitFor('.btnErase1')
                    ->press('.btnErase1')
                    ->waitForText($mess)
                    ->waitUntilMissing('.toast', 11)
                    ->press('Vista')
                    ->script('window.scrollTo(0, 2500);');

            $browser->assertSee('VII. BIBLIOGRAFÍA')
                    ->assertDontSee('Flores Soria, Jaime');

                $this->assertDatabaseMissing('bibliografias', [
                        'semestre' => '20191',
                        'cod_curso' => '100048',
                        'autor' => 'Flores Soria, Jaime'
                    ]);
        });
        // End BIBLIOGRAFIA

    }
}
