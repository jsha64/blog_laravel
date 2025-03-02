<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_subscribe()
    {
        $response = $this->postJson('/api/subscriptions', ['plan' => 'premium']);

        $response->assertStatus(401);
    }

    /** @test */
    public function it_requires_a_plan_to_subscribe()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->postJson('/api/subscriptions', ['plan' => '']);

        $response->assertStatus(422);
    }

    /** @test */
    public function authenticated_users_can_subscribe_with_valid_plan()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user); 

        $response = $this->postJson('/api/subscriptions', ['plan' => 'premium']);

        $response->assertStatus(201);
        $this->assertDatabaseHas('subscriptions', [
            'user_id' => $user->id,
            'plan' => 'premium'
        ]);
    }
}

