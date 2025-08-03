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
        // Mengambil atau membuat kategori layanan
        $kependudukanId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Kependudukan & Pernikahan'])->id;
        $usahaId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Perizinan & Usaha'])->id;
        $sosialId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Layanan Sosial'])->id;
        $lainnyaId = KategoriLayanan::firstOrCreate(['nama_kategori' => 'Lain-lain'])->id;


        $jenisLayanan = [
            // === Kategori: Kependudukan & Pernikahan ===
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
                'nama_layanan' => 'Surat Keterangan Kematian',
                'deskripsi' => 'Surat keterangan untuk keperluan administrasi setelah seseorang meninggal dunia.',
                'slug' => 'surat-kematian'
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
                'nama_layanan' => 'Surat Pengantar SKCK',
                'deskripsi' => 'Surat pengantar untuk pembuatan Surat Keterangan Catatan Kepolisian.',
                'slug' => 'pengantar-skck'
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

            // === Kategori: Lain-lain ===
            [
                'kategori_layanan_id' => $lainnyaId,
                'nama_layanan' => 'Pernyataan Tidak Keberatan',
                'deskripsi' => 'Surat pernyataan tidak keberatan atas suatu kegiatan atau pembangunan.',
                'slug' => 'pernyataan-tidak-keberatan'
            ],

        ];

        foreach ($jenisLayanan as $layanan) {
            // Mencari berdasarkan 'slug', jika ada diupdate, jika tidak ada dibuat baru.
            JenisLayanan::updateOrCreate(
                ['slug' => $layanan['slug']], // Kunci unik
                $layanan // Data
            );
        }

        // Hapus data lama yang tidak ada di daftar baru (termasuk Surat Kuasa)
        $slugsToKeep = array_column($jenisLayanan, 'slug');
        JenisLayanan::whereNotIn('slug', $slugsToKeep)->delete();
    }
}