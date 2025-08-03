<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Kependudukan & Pernikahan', 'deskripsi' => 'Layanan terkait administrasi kependudukan dan pernikahan.'],
            ['nama_kategori' => 'Perizinan & Usaha', 'deskripsi' => 'Layanan untuk legalitas dan keterangan usaha.'],
            ['nama_kategori' => 'Layanan Sosial', 'deskripsi' => 'Layanan bantuan dan rekomendasi sosial.'],
            ['nama_kategori' => 'Lain-lain', 'deskripsi' => 'Berbagai layanan surat keterangan lainnya.'],
        ];

        foreach ($kategori as $item) {
            // Menggunakan updateOrCreate untuk mencegah duplikasi data
            // berdasarkan nama_kategori sebagai kunci unik.
            KategoriLayanan::updateOrCreate(
                ['nama_kategori' => $item['nama_kategori']],
                $item
            );
        }

        // Opsional: Hapus kategori yang tidak lagi digunakan
        $kategoriToKeep = array_column($kategori, 'nama_kategori');
        KategoriLayanan::whereNotIn('nama_kategori', $kategoriToKeep)->delete();
    }
}