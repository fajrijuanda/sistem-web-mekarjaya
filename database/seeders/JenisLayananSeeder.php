<?php

namespace Database\Seeders;

use App\Models\JenisLayanan;
use App\Models\KategoriLayanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class JenisLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan KategoriLayananSeeder sudah dijalankan sebelumnya.
        // Jika belum, data kategori mungkin tidak ditemukan.
        // Disarankan untuk menambahkan kategori baru di KategoriLayananSeeder.
        $kependudukanId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Kependudukan & Pernikahan'])->id;
        $usahaId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Perizinan & Usaha'])->id;
        $sosialId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Layanan Sosial'])->id;
        $pertanahanId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Pertanahan'])->id;
        $lainnyaId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Lain-lain'])->id;


        $jenisLayanan = [
            // === Kategori: Kependudukan & Pernikahan ===
            [
                'kategori_layanan_id' => $kependudukanId,
                'nama_layanan' => 'Surat Pengantar Nikah',
                'deskripsi' => 'Surat pengantar untuk keperluan administrasi pernikahan di KUA.',
                'slug' => 'surat-pengantar-nikah'
            ],
            [
                'kategori_layanan_id' => $kependudukanId,
                'nama_layanan' => 'Surat Keterangan Domisili',
                'deskripsi' => 'Surat keterangan yang menyatakan alamat tinggal atau domisili seseorang.',
                'slug' => 'surat-domisili'
            ],
            [
                'kategori_layanan_id' => $kependudukanId,
                'nama_layanan' => 'Surat Keterangan Kelahiran',
                'deskripsi' => 'Surat keterangan untuk keperluan pembuatan akta kelahiran.',
                'slug' => 'surat-kelahiran'
            ],
            [
                'kategori_layanan_id' => $kependudukanId,
                'nama_layanan' => 'Surat Keterangan Sudah Menikah',
                'deskripsi' => 'Surat pernyataan yang menerangkan status pernikahan seseorang.',
                'slug' => 'surat-sudah-menikah'
            ],
            [
                'kategori_layanan_id' => $kependudukanId,
                'nama_layanan' => 'Surat Keterangan Belum Pernah Menikah',
                'deskripsi' => 'Surat pernyataan yang menerangkan status lajang atau belum menikah.',
                'slug' => 'surat-belum-pernah-menikah'
            ],
            [
                'kategori_layanan_id' => $kependudukanId,
                'nama_layanan' => 'Formulir Permohonan Pindah Datang WNI',
                'deskripsi' => 'Formulir untuk mengurus kepindahan penduduk antar wilayah.',
                'slug' => 'permohonan-pindah-datang'
            ],
            [
                'kategori_layanan_id' => $kependudukanId,
                'nama_layanan' => 'Surat Pengantar SKCK',
                'deskripsi' => 'Surat pengantar untuk pembuatan Surat Keterangan Catatan Kepolisian.',
                'slug' => 'pengantar-skck'
            ],
            [
                'kategori_layanan_id' => $kependudukanId,
                'nama_layanan' => 'Surat Pengantar Pembuatan Paspor',
                'deskripsi' => 'Surat pengantar dari desa untuk keperluan pembuatan paspor.',
                'slug' => 'pembuatan-paspor'
            ],


            // === Kategori: Perizinan & Usaha ===
            [
                'kategori_layanan_id' => $usahaId,
                'nama_layanan' => 'Surat Keterangan Usaha (SKU)',
                'deskripsi' => 'Surat keterangan untuk legalitas dan keperluan administrasi usaha.',
                'slug' => 'surat-keterangan-usaha'
            ],
            [
                'kategori_layanan_id' => $usahaId,
                'nama_layanan' => 'Surat Keterangan Domisili Usaha',
                'deskripsi' => 'Surat yang menerangkan lokasi atau domisili sebuah usaha/perusahaan.',
                'slug' => 'surat-domisili-usaha'
            ],


            // === Kategori: Layanan Sosial ===
            [
                'kategori_layanan_id' => $sosialId,
                'nama_layanan' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'deskripsi' => 'Surat untuk mendapatkan bantuan sosial atau keringanan biaya.',
                'slug' => 'surat-tidak-mampu'
            ],


            // === Kategori: Pertanahan ===
            [
                'kategori_layanan_id' => $pertanahanId,
                'nama_layanan' => 'Surat Keterangan Waris',
                'deskripsi' => 'Surat untuk menyatakan dan mengesahkan para ahli waris yang sah.',
                'slug' => 'keterangan-waris'
            ],
            [
                'kategori_layanan_id' => $pertanahanId,
                'nama_layanan' => 'Surat Pelimpahan Hak Waris',
                'deskripsi' => 'Surat untuk memindahkan hak waris dari satu ahli waris ke yang lainnya.',
                'slug' => 'pelimpahan-hak-waris'
            ],
            [
                'kategori_layanan_id' => $pertanahanId,
                'nama_layanan' => 'Surat Pernyataan Jual Beli Tanah',
                'deskripsi' => 'Surat pernyataan transaksi jual beli tanah sebelum dibuatkan akta resmi.',
                'slug' => 'jual-beli-tanah'
            ],
            [
                'kategori_layanan_id' => $pertanahanId,
                'nama_layanan' => 'Surat Pernyataan Tanah Tidak Sengketa',
                'deskripsi' => 'Surat pernyataan bahwa sebidang tanah tidak dalam sengketa apapun.',
                'slug' => 'tanah-tidak-sengketa'
            ],
            [
                'kategori_layanan_id' => $pertanahanId,
                'nama_layanan' => 'Surat Keterangan Riwayat Tanah',
                'deskripsi' => 'Surat yang menjelaskan sejarah kepemilikan sebidang tanah.',
                'slug' => 'keterangan-riwayat-tanah'
            ],
            [
                'kategori_layanan_id' => $pertanahanId,
                'nama_layanan' => 'Surat Pernyataan Kepemilikan Tanah',
                'deskripsi' => 'Surat pernyataan resmi seseorang atas kepemilikan sebidang tanah.',
                'slug' => 'pernyataan-kepemilikan-tanah'
            ],
            [
                'kategori_layanan_id' => $pertanahanId,
                'nama_layanan' => 'Surat Keterangan Beda Luas Tanah',
                'deskripsi' => 'Surat yang menerangkan perbedaan luas tanah antara dokumen dan fisik.',
                'slug' => 'keterangan-beda-luas-tanah'
            ],


            // === Kategori: Lain-lain ===
            [
                'kategori_layanan_id' => $lainnyaId,
                'nama_layanan' => 'Surat Kuasa',
                'deskripsi' => 'Surat pemberian wewenang atau kuasa dari satu pihak ke pihak lain.',
                'slug' => 'surat-kuasa'
            ],
            [
                'kategori_layanan_id' => $lainnyaId,
                'nama_layanan' => 'Pernyataan Tidak Keberatan',
                'deskripsi' => 'Surat pernyataan tidak keberatan atas suatu kegiatan atau pembangunan.',
                'slug' => 'pernyataan-tidak-keberatan'
            ],

        ];

        foreach ($jenisLayanan as $layanan) {
            // Menggunakan updateOrCreate untuk menghindari duplikasi data.
            // Data akan dicari berdasarkan 'slug', jika ditemukan akan diupdate,
            // jika tidak, akan dibuat data baru.
            JenisLayanan::updateOrCreate(
                ['slug' => $layanan['slug']], // Kunci unik untuk pencarian
                $layanan // Data untuk dibuat atau diupdate
            );
        }
    }
}
