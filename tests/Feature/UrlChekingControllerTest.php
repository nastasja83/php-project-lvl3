<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Tests\TestCase;
use Exception;

class UrlChekingControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testStore()
    {
        $data = [
            'name' => 'http://example.ru',
            'created_at' => Carbon::now()->toString(),
            'updated_at' => Carbon::now()->toString()
        ];

        $id = DB::table('urls')->insertGetId($data);

        $testHtmlPath = __DIR__ . '/../Fixtures/fake.html';
        $testContent = file_get_contents($testHtmlPath);
        if ($testContent === false) {
            throw new Exception('File not found');
        }

        Http::fake([$data['name'] => Http::response($testContent, 200)]);

        $expectedData = [
            'url_id' => $id,
            'status_code' => 200,
            'h1' => 'test_header',
            'title' => 'example',
            'description' => 'test_description'
        ];

        $response = $this->post(route('urls.checks.store', $id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('url_checks', $expectedData);
    }
}
