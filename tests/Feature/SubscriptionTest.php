<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Subscription;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_subscribe_to_a_plan()
    {
        // Crear un usuario
        $user = User::factory()->create();

        // Enviar una solicitud para suscribirse
        $response = $this->actingAs($user)->post('/subscriptions', [
            'plan' => 'basic',
        ]);

        // Verificar que la suscripción fue creada en la base de datos
        $this->assertDatabaseHas('subscriptions', [
            'user_id' => $user->id,
            'plan' => 'basic',
        ]);

        // Verificar que la respuesta fue exitosa
        $response->assertStatus(201);
    }
}
