<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class A02_DocumentsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }


    // protected function setUp()
    // {
    //     parent::setUp();

    //     $_FILES = array(
    //         'image'    =>  array(
    //             'name'      =>  'test.jpg',
    //             'tmp_name'  =>  __DIR__ . '/_files/phpunit-test.jpg',
    //             'type'      =>  'image/jpeg',
    //             'size'      =>  499,
    //             'error'     =>  0
    //         )
    //     );
    // }
    /**
     * @test
     */
    public function an_author_can_upload_a_document()
    {

        $user = User::findOrFail(3);
        $this->actingAs($user);

        $filePath='/tmp/randomstring.doc';

        // Create faker file
        file_put_contents($filePath, "HeaderA,HeaderB,HeaderC\n");

        $this->assertTrue(true);

        $response = $this->postJson('/document/up10', [
            'file' => new UploadedFile($filePath,'randomstring.doc', null, null, null, true),
            'thesis_id'=>1,
            'deal_id' =>1,
            'author_id' => 3,
        ])->assertStatus(200);
    }


}
