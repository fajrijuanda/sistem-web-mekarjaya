<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminKontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun Admin Konten
        User::firstOrCreate(
            ['email' => 'admin.konten@mail.com'],
            [
                'name' => 'Admin Konten',
                'password' => Hash::make('password123'),
                'role' => 'admin-konten',
                'profile_photo_path' => 'avatars/1.png', // Foto default
                'email_verified_at' => now(),
            ]
        );
    }
}