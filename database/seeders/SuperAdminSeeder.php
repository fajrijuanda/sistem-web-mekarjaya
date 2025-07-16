<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun Super Admin
        // Menggunakan firstOrCreate untuk menghindari duplikasi jika seeder dijalankan lagi
        User::firstOrCreate(
            [
                'email' => 'super.admin@mail.com' // Kunci unik untuk pengecekan
            ],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password123'), // Ganti dengan password yang aman
                'role' => 'superadmin',
                'profile_photo_path' => 'avatars/1.png', // Ganti dengan path foto profil yang sesuai
                'email_verified_at' => now() // Opsional: Langsung verifikasi email
            ]
        );
    }
}