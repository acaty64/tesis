<?php

namespace Tests\Browser;

use App\Acceso;
use App\Grupo;
use App\Sumilla;
use App\UserGrupo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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

class A06_MenuTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * An ERASE test.
     *
     * @return void
     */
    public function testMainMenu()
    {
        $this->artisan('db:seed');
        $this->artisan('cache:clear');

        // Menu MASTER
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'master',
                    'user_id' => $user->id
                ]);

        $this->browse(function (Browser $browser) use ($user) {
                    
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSee('Consulta')
                    ->assertSee('Edición')
                    ->assertSee('Comunicación')
                    ->assertSee('Mantenimiento');

            $browser->click('.consulta')
                    ->assertSee('Por curso')
                    ->assertSee('En malla curricular');

            $browser->click('.xCurso')
                    ->assertSee('Syllabus por Curso')
                    ->click('.consulta')
                    ->click('.malla')
                    ->assertSee('Administración')
                    ->assertSee('Contabilidad')
                    ->assertSee('Economía');

            $browser->click('.edicion')
                    ->assertSee('Por Grupo Temático')
                    ->click('.xGrupo')
                    ->assertSee('Visualización o Edición de Syllabus');
        
            $browser->click('.comunicacion')
                    ->assertSee('Comunicados')
                    ->assertSee('Vista Previa');
                    
            $browser->click('.comunicados')
                    ->assertSee('Comunicados Enviados')
                    ->click('.comunicacion')
                    ->click('.preview');
//                    ->assertSee('En construccion')

            $browser->visit('/')
                    ->click('.mantenimiento')
                    ->assertSee('Descarga de Archivos')
                    ->assertSee('Usuarios')
                    ->assertSee('Accesos')
                    ->assertSee('Cursos');
                    
            $browser->click('.download')
                    ->assertSee('Descarga de Syllabus por Grupo Temático')
                    ;
        });

        // Menu ADMINISTRADOR
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'adm',
                    'user_id' => $user->id
                ]);

        $this->browse(function (Browser $browser) use ($user) {
                    
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSee('Consulta')
                    ->assertSee('Edición')
                    ->assertSee('Comunicación')
                    ->assertSee('Mantenimiento')
                    ;
        });

        // Menu RESPONSABLE
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'resp',
                    'user_id' => $user->id
                ]);

        $grupo = Grupo::create([
                'cod_grupo' => 'ADM',
                'wgrupo' => 'ADMINISTRACION'
            ]);
        UserGrupo::create([
                'semestre' => env('SEMESTRE'),
                'user_id' => $user->id,
                'grupo_id' => $grupo->id
            ]);


        $this->browse(function (Browser $browser) use ($user) {
                    
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSee('Consulta')
                    ->assertSee('Edición')
                    ->assertDontSee('Descarga de Archivos')
                    ;

        });

        // Menu DOCENTE
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'doc',
                    'user_id' => $user->id
                ]);

        $this->browse(function (Browser $browser) use ($user) {
                    
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSee('Consulta')
                    ->assertDontSee('Descarga de Archivos')
                    ;

        });

        // Menu CONSULTA
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'doc',
                    'user_id' => $user->id
                ]);

        $this->browse(function (Browser $browser) use ($user) {
                    
            $browser->loginAs($user)
                    ->visit('/')
                    ->assertSee('Consulta')
                    ->assertDontSee('Descarga de Archivos')
                    ;

        });


    }
}
