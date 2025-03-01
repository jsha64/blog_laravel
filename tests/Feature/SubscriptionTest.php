<?php

namespace Tests\Feature;

use App\Models\User;
// use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_subscribe()
    {
        $response = $this->postJson('/subscriptions', ['plan' => 'premium']);

        // $response->assertRedirect('/login');
        $response->assertStatus(401);
    }

    /** @test */
    public function it_requires_a_plan_to_subscribe()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/subscriptions', ['plan' => '']);

        $response->assertSessionHasErrors('plan');
    }

    /** @test */
    public function authenticated_users_can_subscribe_with_valid_plan()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/subscriptions', ['plan' => 'premium']);



        $response->assertStatus(201);
        $this->assertDatabaseHas('subscriptions', [
            'user_id' => $user->id,
            'plan' => 'premium'
        ]);
    }
}
