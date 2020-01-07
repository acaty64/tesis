<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class AuthorUpTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_an_author_can_show_upload_a_document()
    {
        $this->artisan('db:seed');

        $user = $this->defaultUser([],'Autor');
        $this->actingAs($user);

        $response = $this->get('sequence/apply');

        $response->assertStatus(302);
                // ->assertViewIs('app.document.up10');
    }

}
