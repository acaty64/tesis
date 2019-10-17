<?php

namespace Tests\Unit;

use App\CursoStatus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }


    /**

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

     * @test
    public function consistenciaTest()
    {
        $cursoStatus = CursoStatus::create([
                'semestre' => env("SEMESTRE"),
                'curso_id' => 1, 
                'check' => false, 
                'open' => true
            ]);
        $consistencia = CursoStatus::find(1)->consistencia;
        dd($consistencia);
    }
     */


}
