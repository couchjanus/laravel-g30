<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_valid_name_param(): void
    {
        $response = $this->get('/hello/world');

        $response->assertStatus(200);
    }

    public function test_valid_number_param(): void
    {
        $response = $this->get('/hello/123');

        $response->assertStatus(200);
    }

    public function test_valid_string_and_number_param(): void
    {
        $response = $this->get('/hello/world/123');

        $response->assertStatus(200);
    }
}
