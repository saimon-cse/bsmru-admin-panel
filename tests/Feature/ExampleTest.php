<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase; // Use this if you want to refresh the database between tests

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a user for testing
        $this->user = User::factory()->create(); // Requires Laravel 8 or higher
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // Act as the authenticated user
        $this->actingAs($this->user);

        $response = $this->get('/');
        $response->dump(); // Output the response details
        $response->assertStatus(200);
    }
}
