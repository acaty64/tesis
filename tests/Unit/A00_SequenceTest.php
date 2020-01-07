<?php

namespace Tests\Unit;

use App\Deal;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class A00_SequenceTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp(): void
	{
		parent::setUp();
		$this->artisan('db:seed');
	}


    /**
     * @test
     */
    public function it_show_blade_for_create_a_new_thesis_by_Admin()
    {
        $user = $this->defaultUser([],'Admin');
        $this->actingAs($user);
    	$request = $this->get('thesis/create')
    			->assertStatus(302);
    }

    /**
     * @test
     */
    // public function it_show_create_a_new_thesis()
    // {

    //     $this->get('thesis/create')
    //         ->assertStatus(200);
    // }


    /** @test */
    public function it_seek_deals_blades()
    {
// dd(getcwd());
// dd(__DIR__);
        $deals = Deal::where('view','!=',null)->get();
        foreach ($deals as $deal) {
            $blade = $deal->view;
            $blade = getcwd()."/resources/views/".str_replace('.', '/', $blade).'.blade.php';
            $this->assertFileExists($blade);
        }
    }     

}
