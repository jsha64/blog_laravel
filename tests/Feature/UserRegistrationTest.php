<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_blocks_users_under_18()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'birthdate' => now()->subYears(17)->toDateString(),
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['birthdate']);
    }

    /** @test */
    public function it_registers_user_as_inactive()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'birthdate' => now()->subYears(20)->toDateString(),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'is_active' => false,
        ]);
    }
}
