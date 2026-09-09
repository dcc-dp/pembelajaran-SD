<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@sdlc.com',
            ],
            [
                'nama' => 'Super Admin',
                'nama_sekolah' => 'SD Learning Center',
                'no_hp' => '081234567890',
                'password' => Hash::make('password'),
            ]
        );

        $admin->assignRole('Super Admin');
    }
}