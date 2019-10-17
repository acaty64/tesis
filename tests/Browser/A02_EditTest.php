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

class A02_EditTest extends DuskTestCase
{

    use DatabaseMigrations;
    /**
     * An Edit test example.
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
            $browser->loginAs($user)
                    ->visit(route('syllabus.show',['semestre'=>env("SEMESTRE"),'cod_curso'=>'100048','edit'=>true]))
                    ->waitFor('.SyllabusComponent', 20)
                    ->waitFor('.Vista', 20)
                    ->waitForText('Sumillas', 10)
                    ->press('Sumillas')
                    ->assertSee('II. SUMILLA')
                    ->assertSee('El curso tiene como propósito')
                    ->click('.btnEdit1')
                    ->waitFor('.id1.sumillas',20)
                    ->clear('.id1.sumillas')
                    ->type('.sumillas', 'xxxxx')
                    ->assertSee('xxxxx')
                    ->click('.btnSave1')
                    ->waitForText('Sumilla grabada.')
                    ->waitUntilMissing('.toast', 11);

            $this->assertDatabaseHas('sumillas', [
                        'texto' => 'xxxxx'
                    ]);
        });
        // End SUMILLAS

        // UNIDADES
        $this->browse(function (Browser $browser) {
            $browser->press('Unidades')
                    ->assertSee('UNIDADES')
                    ->assertSee('LA CONTABILIDAD GERENCIAL.')
                    ->click('.btnEdit2')
                    ->clear('.id2.col-2')
                    ->type('.id2.col-2', 'yyyyy')
                    ->assertSee('yyyyy')
                    ->click('.btnSave2')
                    ->waitForText('Unidad grabada.')
                    ->assertSee('Unidad grabada.')
                    ->waitUntilMissing('.toast', 11);

        $this->assertDatabaseHas('unidades', [
                        'texto' => 'yyyyy'
                    ]);
        });
        // End UNIDADES


        // CONTENIDOS
        $this->browse(function (Browser $browser) {
            $browser->press('Contenidos')
                    ->assertSee('CONTENIDOS')
                    ->assertSee('La contabilidad gerencial.')
                    ->click('.btnEdit3')
                    ->clear('.id3.col-2')
                    ->type('.id3.col-2', 'zzzzzzz')
                    ->assertSee('zzzzzzz')
                    ->click('.btnSave3')
                    ->waitForText('Contenido grabado.')
                    ->assertSee('Contenido grabado.')
                    ->waitUntilMissing('.toast', 11);
 
        $this->assertDatabaseHas('contenidos', [
                        'concepto' => 'zzzzzzz'
                    ]);
        });

        // ESTRATEGIAS
        $this->browse(function (Browser $browser) {
            $browser->press('Estrategias')
                    ->assertSee('V. ESTRATEGIAS METODOLÓGICAS')
                    ->assertSee('Lecturas')
                    ->assertSee('Editar')
                    ->press('.btnEdit1')
                    ->clear('.estrategias')
                    ->type('.estrategias', 'xxxxx')
                    ->assertSee('xxxxx')
                    ->click('.btnSave1')
                    ->waitForText('Estrategias grabadas.')
                    ->assertSee('Estrategias grabadas.')
                    ->waitUntilMissing('.toast', 11);
        
        $this->assertDatabaseHas('estrategias', [
                        'texto' => 'xxxxx'
                    ]);
        });
        // End ESTRATEGIAS


        // EVALUACIONES
        $this->browse(function (Browser $browser) {
            $browser->press('Evaluaciones')
                    ->assertSee('EVALUACIONES')
                    ->waitForText('PORCENTAJE', 20)
                    ->click('.btnEdit2')
                    ->clear('.id2.col-1')
                    ->type('.id2.col-1', 'yyyyy')
                    ->assertSee('yyyyy')
                    ->click('.btnSave2')
                    ->waitForText('Evaluacion grabada.')
                    ->assertSee('Evaluacion grabada.')
                    ->waitUntilMissing('.toast', 11);

        $this->assertDatabaseHas('evaluaciones', [
                        'texto' => 'yyyyy'
                    ]);
        });
        // End EVALUACIONES

        // BIBLIOGRAFIA
        $this->browse(function (Browser $browser) {
            $browser->press('Bibliografias')
                    ->assertSee('BIBLIOGRAFÍA')
                    ->assertSee('Autor(es)')
                    ->click('.btnEdit2')
                    ->clear('.id2.col-1')
                    ->type('.id2.col-1', 'zzzzz')
                    ->type('.id2.col-4', '2016')
                    ->assertSee('zzzzz')
                    ->click('.btnSave2')
                    ->waitForText('Bibliografía grabada.')
                    ->waitUntilMissing('.toast', 11);

        $this->assertDatabaseHas('bibliografias', [
                        'autor' => 'zzzzz'
                    ]);
        });
        // End BIBLIOGRAFIA


    }



}
