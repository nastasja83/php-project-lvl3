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
        $name = 'https://example2.com';
        $data = ['url' => ['name' => $name]];
        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasNoErrors();
        $url = DB::table('urls')->where(['name' => $name])->first();
        $response->assertRedirect(route('urls.show', ['url' => $url->id]));

        $this->assertDatabaseHas('urls', $data['url']);
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
