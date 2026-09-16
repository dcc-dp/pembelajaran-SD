<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $this->seed(\Database\Seeders\RoleSeeder::class);

        $response = $this->post('/register', [
            'nama' => 'Test Guru',
            'nama_sekolah' => 'SD Negeri 1 Contoh',
            'email' => 'guru@example.com',
            'no_hp' => '081234567890',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('status');
    }
}
