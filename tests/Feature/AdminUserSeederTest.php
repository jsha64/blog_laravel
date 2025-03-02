<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;

class AdminUserSeederTest extends TestCase
{
    use RefreshDatabase; // 🔹 Limpia la base de datos en cada prueba

    /** @test */
    public function it_creates_the_admin_user()
    {
        // Ejecutar el seeder
        $this->seed(AdminUserSeeder::class);

        // Verificar que el usuario admin existe en la base de datos
        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'is_admin' => true,
            'is_active' => true
        ]);

        // Verificar que el usuario fue creado correctamente
        $admin = User::where('email', 'admin@example.com')->first();
        $this->assertNotNull($admin);
        $this->assertTrue((bool) $admin->is_admin);
        $this->assertTrue((bool) $admin->is_active);
    }
}
