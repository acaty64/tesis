<?php

namespace Tests\Unit;


use App\Tuser;
use App\Tuser_user;
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
    public function administrador_can_create_a_user()
    {
        // Usuario Administrador
        $this->defaultUsers();
        $type_id = Tuser::where('name', 'Administrador')->first()->id;
        $user_id = Tuser_user::where('tuser_id', $type_id)->first()->user_id;
        $user = User::findOrFail($user_id);
        $this->actingAs($user);

        $request = [
                '_token' => csrf_token(),
                'name' => 'Nuevo Usuario',
                'email' => 'nuevousuario@gmail.com',
                'password' => 'password',
                // 'codigo' => '000001',
                // 'fono' => '955555511',
                // 'tuser_id' => 2 
            ];
        $this->post(route('users.store'),$request);

        $this->assertDatabaseHas("users", [
            'name' => $request['name'],
            'email' => $request['email'],
        ]);
        // $new_user = User::where('name', $request['name'])->first();
        // $this->assertDatabaseHas("user_details", [
        //     'user_id' => $new_user->id,
        //     'fono' => $request['fono'],
        //     'codigo' => $request['codigo'],
        // ]);
        // $this->assertDatabaseHas("tuser_user", [
        //     'user_id' => $new_user->id,
        //     'tuser_id' => $request['tuser_id'],
        // ]);
    }

    /** @test */
    // public function administrador_can_edit_a_user()
    // {
    //     // Usuario Administrador
    //     $user = $this->defaultUser();
    //     $userAcceso = $this->defaultUserAcceso([
    //                 'cod_acceso'=>'adm',
    //                 'user_id' => $user->id
    //             ]);
    //     $this->actingAs($user);

    //     $new_user = User::create([
    //                 'name' => 'Nuevo Usuario',
    //                 'email' => 'usuario@gmail.com',
    //                 'password' => 'password'
    //             ]);
    //     $newAcceso = $this->defaultUserAcceso([
    //                 'cod_acceso'=>'resp',
    //                 'user_id' => $new_user->id
    //             ]);

    //     $new_user->name = 'Usuario modificado';
    //     $new_user->email = 'otrousuario@gmail.com';
    //     $request = [
    //             '_token' => csrf_token(),
    //             'id' => $new_user->id,
    //             'name' => $new_user->name,
    //             'email' => $new_user->email,
    //             'password' => $new_user->password,
    //             'cod_doc' => $new_user->cod_doc,
    //             'acceso_id' => 3,
    //         ];
    //     $this->post(route('users.update'), $request);

    //     $this->assertDatabaseHas("users", [
    //         'name' => $new_user->name,
    //         'email' => $new_user->email,
    //     ]);
    // }
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
