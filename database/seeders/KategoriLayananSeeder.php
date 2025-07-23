<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriLayananSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Kependudukan', 'deskripsi' => 'Layanan terkait administrasi data penduduk.'],
            ['nama_kategori' => 'Perizinan Usaha', 'deskripsi' => 'Layanan untuk legalitas dan keterangan usaha.'],
            ['nama_kategori' => 'Layanan Sosial', 'deskripsi' => 'Layanan bantuan dan rekomendasi sosial.'],
        ];

        foreach ($kategori as $item) {
            KategoriLayanan::create($item);
        }
    }
}