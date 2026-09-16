<?php

namespace Tests\Feature\Guru;

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_redirected_to_login_when_accessing_guru_dashboard(): void
    {
        $response = $this->get('/guru/dashboard');

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_guru_can_render_guru_dashboard(): void
    {
        $this->seed(RoleSeeder::class);

        $user = User::create([
            'nama' => 'Ibu Guru Ani',
            'nama_sekolah' => 'SDN 01 Menteng',
            'email' => 'guruani@example.com',
            'no_hp' => '08123456789',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('Guru');

        $response = $this->actingAs($user)->get('/guru/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Ibu Guru Ani');
        $response->assertSee('SDN 01 Menteng');
        $response->assertSee('SD Learning Center');
        $response->assertSee('Total Repository');
        $response->assertSee('Total Unduhan');
        $response->assertSee('Status Langganan');
        $response->assertSee('Sisa Masa Langganan');
    }
}
