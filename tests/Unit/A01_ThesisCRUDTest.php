<?php

namespace Tests\Unit;


use App\Deal;
use App\Sequence;
use App\Tdeal;
use App\Tuser;
use App\Tuser_user;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class A01_ThesisCRUDTest extends TestCase
{
	use DatabaseMigrations;

    /** @test */
    public function create_a_new_thesis()
    {
        $this->get(route('thesis.create'))
            ->assertStatus(302);
    }
    /** @test */
    public function store_a_new_thesis()
    {

        // // This will seed your database
        // Artisan::call('db:seed');

        // If you wan to seed a specific table

        Artisan::call('db:seed', ['--class' => 'UsersTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TusersTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TuserUserTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'SequencesTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'DealsTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TdealsTableSeeder', '--database' => 'mysql_tests']);

        $user = User::findOrFail(4);
        $application = '123456';
        $title = 'Thesis Title Test';
        $request = [
            'author_id' => $user->id,
            'application' => $application,
            'title' => $title
        ];
        $this->post(route('thesis.store'), $request)
            ->assertStatus(302);        

    }
    /** @test */
    public function read_all_thesis()
    {
        $this->get(route('thesis.index'))
            ->assertStatus(200);

    }
    /** @test */
    public function upload_a_thesis()
    {

    }
    /** @test */
    public function delete_a_thesis()
    {

    }
}
