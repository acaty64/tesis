<?php

namespace Tests\Unit;

use App\Acceso;
use App\Contenido;
use App\Grupo;
use App\Sumilla;
use App\User;
use App\UserAcceso;
use App\UserGrupo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class A00_AccesoTest extends TestCase
{
	use DatabaseMigrations;

//		$this->seed('DatabaseSeeder');

/*
	public function setUp(): void
	{
		parent::setUp();
		$this->artisan('db:seed');
	}
*/

    /**
     * @test
     */
    public function it_does_not_allow_guests_to_discover_auths_urls()
    {
		$this->get('invalid-url')
			->assertStatus(404);
//			->assertRedirect('login');
    }

    /**
     * @test
     */
    public function it_displays_404s_when_auths_visit_invalid_url()
    {
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'doc',
                    'user_id' => $user->id
                ]);
        $this->actingAs($user);

        $response = $this->get('invalid-url');
		$response->assertStatus(404);
    }

    /**
     * A 'master' access test example.
     *
     * @test
     */
    public function check_masterTest()
    {
/*
        $acceso_id = Acceso::where('cod_acceso', 'master')->first()->id;
        $user_id = UserAcceso::where('acceso_id', $acceso_id)->first()->user_id;
        //->$user_id;
        $user = User::find($user_id);
        $this->actingAs($user);
*/
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'master',
                    'user_id' => $user->id
                ]);
        $this->actingAs($user);

        $response = $this->get('sys/backup');
        $response->assertStatus(200);
        $response->assertViewIs('backup.index');
//      $this->markTestIncomplete();        
    }

    /**
     * An 'administrador' access test example.
     *
     * @test
     */
    public function administradorTest()
    {
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'adm',
                    'user_id' => $user->id
                ]);
        $this->actingAs($user);
        $response = $this->get('adm/grupos/show');
    	$response->assertStatus(200);
    	$response->assertViewIs('app.grupos');
//		$this->markTestIncomplete();
        // An administrador don't access backup.index
        $response = $this->get('sys/backup');
        $response->assertStatus(302);            	
    }

    /**
     * A 'responsable' access test example.
     *
     * @test
     */
    public function responsableTest()
    {
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

        $this->actingAs($user);
        $response = $this->get('resp/cursogrupo/ADM');
        $response->assertStatus(200);
        $response->assertViewIs('app.cursoGrupo');
        // A responsable don't access adm/grupos
        $response = $this->get('adm/grupos/show');
        $response->assertStatus(302);      

        //$this->markTestIncomplete();
    }

    /**
     * A 'docente' access test example.
     *
     * @test
     */
    public function docenteTest()
    {
        $this->artisan('db:seed');
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'doc',
                    'user_id' => $user->id
                ]);
        $this->actingAs($user);
        $response = $this->get('doc/edit/'.env("SEMESTRE").'/100048');
        $response->assertStatus(200);
        $response->assertViewIs('app.show');
        // A responsable don't access resp/cursogrupo/ADM
        $response = $this->get('resp/cursogrupo/ADM');
        $response->assertStatus(302);    
        //$this->markTestIncomplete();        
    }
     


}
