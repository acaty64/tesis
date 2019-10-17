<?php

namespace Tests\Unit;


use App\Acceso;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class A00_UsersTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
/*  EN CONSTRUCCION
    public function administrador_can_create_a_user()
    {

        // Usuario Administrador
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'adm',
                    'user_id' => $user->id
                ]);
        $this->actingAs($user);

        $new_user = new User([
                    'name' => 'Nuevo Usuario',
                    'email' => 'usuario@gmail.com',
                    'password' => 'password',
                    'cod_doc' => '000001',
                ]);

        $request = [
                '_token' => csrf_token(),
                'id' => $new_user->id,
                'name' => $new_user->name,
                'email' => $new_user->email,
                'password' => $new_user->password,
                'cod_doc' => $new_user->cod_doc,
                'acceso_id' => 2,
            ];
        $this->post(route('users.store'),$request);

        $this->assertDatabaseHas("users", [
            'name' => $new_user->name,
            'email' => $new_user->email,
            'cod_doc' => $new_user->cod_doc,
        ]);
        $new_user = User::where('name', $new_user->name)->first();
        $this->assertDatabaseHas("userAcceso", [
            'user_id' => $new_user->id,
            'acceso_id' => 2,
        ]);
    }
*/

    /** @test */
    public function administrador_can_edit_a_user()
    {
        // Usuario Administrador
        $user = $this->defaultUser();
        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'adm',
                    'user_id' => $user->id
                ]);
        $this->actingAs($user);

        $new_user = User::create([
                    'name' => 'Nuevo Usuario',
                    'email' => 'usuario@gmail.com',
                    'password' => 'password'
                ]);
        $newAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'resp',
                    'user_id' => $new_user->id
                ]);

        $new_user->name = 'Usuario modificado';
        $new_user->email = 'otrousuario@gmail.com';
        $request = [
                '_token' => csrf_token(),
                'id' => $new_user->id,
                'name' => $new_user->name,
                'email' => $new_user->email,
                'password' => $new_user->password,
                'cod_doc' => $new_user->cod_doc,
                'acceso_id' => 3,
            ];
        $this->post(route('users.update'), $request);

        $this->assertDatabaseHas("users", [
            'name' => $new_user->name,
            'email' => $new_user->email,
        ]);
    }
    /** @test */
/* BLADE EN CONSTRUCCION
    public function administrador_can_delete_a_user()
    {
        // Usuario Administrador
        $admin = $this->defaultUser();
        $adminAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'adm',
                    'user_id' => $admin->id
                ]);
        $this->actingAs($admin);

        $user = User::create([
                    'name' => 'Nuevo Usuario',
                    'email' => 'usuario@gmail.com',
                    'password' => 'password'
                ]);

        $userAcceso = $this->defaultUserAcceso([
                    'cod_acceso'=>'resp',
                    'user_id' => $user->id
                ]);

        $this->get(route('users.destroy', $user->id));

        $this->assertDatabaseMissing("users", [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $this->assertDatabaseMissing("user_accesos", [
            'user_id' => $user->id,
            'acceso_id' => $userAcceso->id,
        ]);
    }
*/
}
