<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ForecastTest extends TestCase
{
    /**
     * Test that the page loads correctly.
     *
     * @return void
     */
    public function testPageLoads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Tampa');
    }
}
