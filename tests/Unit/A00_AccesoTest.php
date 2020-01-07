<?php

namespace Tests\Unit;

use App\Acceso;
use App\Tuser;
use App\Tuser_user;
use App\User;
use App\UserAcceso;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class A00_AccesoTest extends TestCase
{
	use DatabaseMigrations;

	// public function setUp(): void
	// {
	// 	parent::setUp();
	// 	$this->artisan('db:seed');
	// }


    /**
     * @test
     */
    public function it_does_not_allow_guests_to_discover_auths_urls()
    {
		$response = $this->get('invalid-url')			
            ->assertStatus(302);
            // ->assertViewIs('auth.login');
            // ->assertViewIs('error.404');
//			->assertRedirect('login');
    }

    /**
     * @test
     */
    public function it_displays_404s_when_auths_visit_invalid_url()
    {
    	// $this->seed('DatabaseSeeder');
        $this->defaultUsers();
        $user = User::findOrFail(1);
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
        $this->defaultUsers();
        // $this->seed('DatabaseSeeder');
        $type_id = Tuser::where('name', 'Master')->first()->id;
        $user_id = Tuser_user::where('tuser_id', $type_id)->first()->user_id;
        $user = User::findOrFail($user_id);
        $this->actingAs($user);
// dd($user->tuser_user, $user->tuser, $type_id, $user_id);
        $response = $this->get('sys/tests');
        $response->assertStatus(200);
        $response->assertViewIs('tests');
    }

    /**
     * An 'administrador' access test example.
     *
     * @test
     */
    public function administradorTest()
    {
		// $this->markTestIncomplete();
        $this->defaultUsers();
        $type_id = Tuser::where('name', 'Administrador')->first()->id;
        $user_id = Tuser_user::where('tuser_id', $type_id)->first()->user_id;
        $user = User::findOrFail($user_id);
        $this->actingAs($user);

        $response = $this->get('admin/tests');
        $response->assertStatus(200);
        $response->assertViewIs('tests');
        // An administrador don't access sys/tests
        $response = $this->get('sys/tests');
        $response->assertStatus(302);            	
    }

    /**
     * A 'autor' access test example.
     *
     * @test
     */
    public function autorTest()
    {
        // $this->markTestIncomplete();
        // $this->seed('DatabaseSeeder');
        $this->defaultUsers();
        $type_id = Tuser::where('name', 'Autor')->first()->id;
        $user_id = Tuser_user::where('tuser_id', $type_id)->first()->user_id;
        $user = User::findOrFail($user_id);
        $this->actingAs($user);

        $response = $this->get('autor/tests');
        $response->assertStatus(200);
        $response->assertViewIs('tests');

        // An autor don't access sys/tests
        $response = $this->get('sys/tests');
        $response->assertStatus(302);               

    }

    /**
     * A 'docente' access test example.
     *
     * @test
     */
    public function asesorTest()
    {
        $user = $this->defaultUsers();
        $type_id = Tuser::where('name', 'Asesor')->first()->id;
        $user_id = Tuser_user::where('tuser_id', $type_id)->first()->user_id;
        $user = User::findOrFail($user_id);
        $this->actingAs($user);

        $response = $this->get('asesor/tests');
        $response->assertStatus(200);
        $response->assertViewIs('tests');

        // An advisor don't access sys/tests
        $response = $this->get('sys/tests');
        $response->assertStatus(302);               

    }
     


}
