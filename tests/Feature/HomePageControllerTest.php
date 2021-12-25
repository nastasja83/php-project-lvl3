<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomePageControllerTest extends TestCase
{
    public function testHome(): void
    {
        $response = $this->get(route('home'));
        $response->assertOk();
    }
}
