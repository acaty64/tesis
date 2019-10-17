<?php

namespace Tests\Browser;

use App\Acceso;
use App\Grupo;
use App\Send;
use App\Sumilla;
use App\User;
use App\UserAcceso;
use App\UserGrupo;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Jenssegers\Date\Date;
use Laravel\Dusk\Browser;
use Tests\DuskData;
use Tests\DuskTestCase;

    /**
     * 1. Master Ok
     * 2. Administrador Ok
     * 3. Responsable Ok
     * 4. Docente Ok
     * 5. Consulta Ok
     */

class A07_ComunicationTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function send_mail_to_responsable()
    {
        $this->artisan('cache:clear');
        $this->artisan('db:seed');

        $user = $this->defaultUser();
        $acceso_id = Acceso::where('cod_acceso', 'adm')->first();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'adm',
                    'user_id' => $user->id
                ]);
        
        $date_send = Carbon::now();
        $date_answer = Carbon::now()->addDay();

        $grupo = Grupo::find(5);
        $responsable = $grupo->responsable;

        $this->browse(function (Browser $browser) use ($user, $responsable, $date_send, $date_answer, $grupo) {                    
            // Usuario ADMINISTRADOR
            $browser->loginAs($user)
                    ->visit('/adm/send')
                    ->assertSee('Comunicados Enviados')
                    ->press('.crear')
                    ->assertSee('Crear Nuevo Comunicado')
                    ->waitForText($responsable->email, 10)
                    ->select('flimite', $date_answer)
                    ->click('#userGrupo_5')
                    ->script('window.scrollTo(0, 300);');
            $browser->press('.enviar')
                    ->assertSee('Comunicados Enviados')
                    ->assertSee($responsable->name)
                    ->assertSee($date_send)
                    ->assertSee($date_answer);

            $texto = "Acceso a módulo Syllabus";                
            $this->assertDatabaseHas('sends', [
//                        'semestre' => '20191',
                        'user_id' => $responsable->id,
                        'texto' => $texto,
                        'date_send' => $date_send->toDateString(),
                        'date_answer' => $date_answer->toDateString(),
                        'date_response' => null
                    ]);
            foreach ($grupo->cursos as $cursogrupo) {
//dd($cursogrupo);
                $this->assertDatabaseHas('curso_status', [
                        'semestre' => env("SEMESTRE"),
                        'curso_id' => $cursogrupo->curso->id,
                        'check' => false,
                        'open' => true
                    ]);
            }

            $resp = User::find($responsable->id);
            $grupo = $resp->grupo;
            // Usuario RESPONSABLE


            $fechaC = Carbon::now()->addDays(1);
            $fecha = new Date($fechaC);
            $browser->loginAs($resp)
                    ->visit('/')
                    ->press('.edicion')
                    ->press('.xGrupo')
                    ->waitForText('Cursos de Grupo:', 10)
                    ->assertSee('Cursos de Grupo: ' . $grupo->cod_grupo)
                    ->assertSee('El módulo de edición de syllabus está disponible hasta el día '. $fecha->format('l d-m-Y'))
                    ->assertSee('Incompleto')
                    ;

        });

        // 






    }
}
