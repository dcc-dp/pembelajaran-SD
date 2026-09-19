<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_redirected_to_login_when_accessing_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect(route('login'));
    }

    public function test_super_admin_is_redirected_to_admin_dashboard(): void
    {
        $this->seed(RoleSeeder::class);

        $admin = User::create([
            'nama' => 'Super Admin Test',
            'email' => 'admin@example.com',
            'no_hp' => '08123456789',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('Super Admin');

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_guru_is_redirected_to_guru_dashboard(): void
    {
        $this->seed(RoleSeeder::class);

        $guru = User::create([
            'nama' => 'Guru Test',
            'email' => 'guru@example.com',
            'no_hp' => '08987654321',
            'password' => bcrypt('password'),
        ]);
        $guru->assignRole('Guru');

        $response = $this->actingAs($guru)->get('/dashboard');

        $response->assertRedirect(route('guru.dashboard.index'));
    }
}
