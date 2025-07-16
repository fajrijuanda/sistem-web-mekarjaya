<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminPelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun Admin Pelayanan
        User::firstOrCreate(
            ['email' => 'admin.pelayanan@mail.com'],
            [
                'name' => 'Admin Pelayanan',
                'password' => Hash::make('password123'),
                'role' => 'admin-pelayanan',
                'profile_photo_path' => 'avatars/1.png', // Foto default
                'email_verified_at' => now(),
            ]
        );
    }
}