<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        DB::table('urls')->insert([
                'name' => 'https://example.ru',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
        ]);
    }

    public function testIndex()
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testStore()
    {
        $data = ['name' => 'http://example2.com'];
        $response = $this->followingRedirects()->post(route('urls.store'), ['url' => $data]);
        $response->assertSessionHasNoErrors();
        $response->assertOk();
        $response->assertSeeText($data['name']);

        $this->assertDatabaseHas('urls', $data);
    }

    public function testShow()
    {
        $name = 'https://example3.com';
        $id = DB::table('urls')->insertGetId(['name' => $name]);
        $response = $this->get(route('urls.show', ['url' => $id]));
        $response->assertOk();
        $response->assertSeeText($name);
    }
}
