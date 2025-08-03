<?php

namespace Database\Seeders;

use App\Models\ProfilDesa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProfilDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Path ke file JSON lama Anda
        $jsonPath = public_path('assets/json/profile-desa.json');

        if (File::exists($jsonPath)) {
            $jsonContent = File::get($jsonPath);
            $data = json_decode($jsonContent, true);

            // Gunakan updateOrCreate untuk memastikan hanya ada satu baris data profil
            // dan seeder bisa dijalankan berulang kali tanpa error.
            ProfilDesa::updateOrCreate(
                ['id' => 1], // Selalu update baris dengan ID 1
                ['konten' => $data]
            );
        }
    }
}