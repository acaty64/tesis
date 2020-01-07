<?php

namespace Tests\Unit;


use App\Deal;
use App\Sequence;
use App\Tdeal;
use App\Thesis;
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
        $user = $this->defaultUser([],'Admin');
        $this->actingAs($user);        
        $this->get(route('thesis.create'))
            ->assertStatus(302);
    }
    /** @test */
    public function store_a_new_thesis()
    {
        //// TODO: Add advisor Comite
        Artisan::call('db:seed', ['--class' => 'UsersTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TusersTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TuserUserTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'SequencesTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'DealsTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TdealsTableSeeder', '--database' => 'mysql_tests']);

        $user = User::findOrFail(2);
        $this->actingAs($user);
        $application = '123456';
        $title = 'Thesis Title Test';
        $advisor = Tuser_user::where('tuser_id', 4)->first();
        $request = [
            'author_id' => $user->id,
            'application' => $application,
            'title' => $title,
            'advisor_id' => $advisor->id,
            'tadvisor_id' => 3
        ];
        $this->post(route('thesis.store'), $request)
            ->assertStatus(302);
        $this->assertDatabaseHas("theses", [
            'serie' => 1,
            'application' => $application,
        ]);
        $this->assertDatabaseHas("titles", [
            'thesis_id' => 1,
            'title' => $title,
        ]);
        $this->assertDatabaseHas("authors", [
            'thesis_id' => 1,
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas("advisors", [
            'thesis_id' => 1,
            'tadvisor_id' => 3,
            'user_id' => $advisor->id,
        ]);
    }
    /** @test */
    public function read_all_thesis()
    {
        $user = $this->defaultUser([],'Admin');
        $this->actingAs($user);
        $this->get(route('thesis.index'))
             ->assertStatus(302);

    }
    /** @test */
    /// Modify advisor Comite
    public function update_a_thesis()
    {
        Artisan::call('db:seed', ['--class' => 'UsersTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TusersTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TuserUserTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'SequencesTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'DealsTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TdealsTableSeeder', '--database' => 'mysql_tests']);

        $user = User::findOrFail(2);
        $this->actingAs($user);
        $old_serie = 1;
        $old_author = 3;
        $old_application = '123456';
        $old_title = 'Thesis Title Test';
        $advisors = Tuser_user::where('tuser_id', 4)->get();
        $old_advisor = $advisors->first();
        $request = [
            'serie' => $old_serie,
            'author_id' => $old_author,
            'application' => $old_application,
            'title' => $old_title,
            'advisor_id' => $old_advisor->id,
            'tadvisor_id' => 3
        ];
        $this->post(route('thesis.store'), $request)
            ->assertStatus(302);

        $thesis_id = count(Thesis::all());
        $users = User::all();
        $new_author_id = $users->sortByDesc('id')->first()->id;
        $new_application = '654321';
        $new_title = 'New Title Test';
        $new_advisor = $advisors->sortByDesc('id')->first();
        $request = [
            'thesis_id' => $thesis_id,
            'serie' => $old_serie,
            'author_id' => $new_author_id,
            'oldAuthor_id' => $old_author,
            'application' => $new_application,
            'title' => $new_title,
            'advisor_id' => $new_advisor->id,
            'tadvisor_id' => 3
        ];

        $this->post(route('thesis.update'), $request)
            ->assertStatus(302);
        $this->assertDatabaseMissing("theses", [
            'id' => $thesis_id,
            'serie' => $old_serie,
            'application' => $old_application,
        ]);
        $this->assertDatabaseMissing("titles", [
            'thesis_id' => $thesis_id,
            'title' => $old_title,
        ]);
        $this->assertDatabaseMissing("authors", [
            'thesis_id' => $thesis_id,
            'user_id' => $old_author,
        ]);
        $this->assertDatabaseMissing("advisors", [
            'thesis_id' => $thesis_id,
            'tadvisor_id' => $request['tadvisor_id'],
            'user_id' => $old_advisor->id,
        ]);

        $this->assertDatabaseHas("theses", [
            'id' => $thesis_id,
            'serie' => $old_serie,
            'application' => $new_application,
        ]);
        $this->assertDatabaseHas("titles", [
            'thesis_id' => $thesis_id,
            'title' => $new_title,
        ]);
        $this->assertDatabaseHas("authors", [
            'thesis_id' => $thesis_id,
            'user_id' => $new_author_id,
        ]);
        $this->assertDatabaseHas("advisors", [
            'thesis_id' => $thesis_id,
            'tadvisor_id' => 3,
            'user_id' => $new_advisor->id,
        ]);
    }
    /** @test */
    public function delete_a_thesis()
    {
        //// TODO: Registrar y evaluar eliminacion de Advisors -> Comite

        Artisan::call('db:seed', ['--class' => 'UsersTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TusersTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TuserUserTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'AdvisorsTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'SequencesTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'DealsTableSeeder', '--database' => 'mysql_tests']);

        Artisan::call('db:seed', ['--class' => 'TdealsTableSeeder', '--database' => 'mysql_tests']);


        $user = User::findOrFail(2);
        $this->actingAs($user);
        $thesis_id = count(Thesis::all());        
        $old_serie = 1;
        $old_author = 3;
        $old_application = '123456';
        $old_title = 'Thesis Title Test';
        $advisors = Tuser_user::where('tuser_id', 4)->get();
        $old_advisor = $advisors->first();
        $request = [
            'serie' => $old_serie,
            'author_id' => $old_author,
            'application' => $old_application,
            'title' => $old_title,
            'advisor_id' => $old_advisor->id,
            'tadvisor_id' => 3
        ];
        $this->post(route('thesis.store'), $request)
            ->assertStatus(302);

        $this->get('thesis/destroy/1')
            ->assertStatus(302);

        $author_id = $request['author_id'];
        $title = $request['title'];
        $this->assertDatabaseMissing("theses", [
            'serie' => 1,
            'application' => $request['application'],
        ]);
        $this->assertDatabaseMissing("titles", [
            'thesis_id' => 1,
            'title' => $request['title'],
        ]);
        $this->assertDatabaseMissing("authors", [
            'thesis_id' => 1,
            'user_id' => $request['author_id'],
        ]);
        $this->assertDatabaseMissing("advisors", [
            'thesis_id' => $thesis_id,
            'tadvisor_id' => $request['tadvisor_id'],
            'user_id' => $old_advisor->id,
        ]);

    }
}
