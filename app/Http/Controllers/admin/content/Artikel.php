<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
// use App\Models\Article; // Hapus atau komentari baris ini jika Anda tidak ingin menggunakan model database

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Tambahkan ini untuk membaca file JSON

class Artikel extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        return view('content.admin.contents.pages.artikel', ['pageConfigs' => $pageConfigs]);
    }

    // create
    public function create()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        return view('content.admin.contents.pages.create-artikel-2', ['pageConfigs' => $pageConfigs]);
    }

    // Dalam controller Anda
    public function show($slug)
    {
        $pageConfigs = ['myLayout' => 'horizontal'];

        // --- Bagian Perubahan Utama Dimulai Di Sini ---
        $article = null; // Inisialisasi artikel
        $jsonFilePath = public_path('assets/json/data-artikel.json'); // Pastikan path ini benar

        if (File::exists($jsonFilePath)) {
            $jsonData = File::get($jsonFilePath);
            $articlesData = json_decode($jsonData, true);

            // Cari artikel berdasarkan slug dari data JSON
            if (isset($articlesData['data']) && is_array($articlesData['data'])) {
                foreach ($articlesData['data'] as $item) {
                    if (isset($item['slug']) && $item['slug'] === $slug) {
                        $article = (object) $item; // Ubah array menjadi objek untuk konsistensi di Blade

                        // Tambahkan 'thumbnail_url' jika menggunakan 'gambar_unggulan'
                        // Ini penting agar Blade view Anda ($article->thumbnail_url) tidak error
                        if (isset($article->gambar_unggulan) && $article->gambar_unggulan) {
                            $article->thumbnail_url = asset('assets/img/artikel/' . $article->gambar_unggulan);
                        } else {
                            $article->thumbnail_url = null;
                        }

                        // Ubah format tanggal_terbit agar kompatibel dengan Carbon
                        // jika tanggal_terbit dari JSON masih "14 Juli 2025"
                        // Jika format JSONnya sudah "YYYY-MM-DD" maka tidak perlu perubahan
                        if (isset($article->tanggal_terbit)) {
                            try {
                                // Ini hanya contoh parsing tanggal non-standar.
                                // Lebih baik lagi jika JSON Anda sudah YYYY-MM-DD
                                $monthMap = [
                                    'Januari' => 1,
                                    'Februari' => 2,
                                    'Maret' => 3,
                                    'April' => 4,
                                    'Mei' => 5,
                                    'Juni' => 6,
                                    'Juli' => 7,
                                    'Agustus' => 8,
                                    'September' => 9,
                                    'Oktober' => 10,
                                    'November' => 11,
                                    'Desember' => 12
                                ];
                                $parts = explode(' ', $article->tanggal_terbit);
                                if (count($parts) === 3) {
                                    $day = (int) $parts[0];
                                    $month = $monthMap[$parts[1]] ?? null;
                                    $year = (int) $parts[2];
                                    if ($month) {
                                        $article->published_at = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
                                    } else {
                                        $article->published_at = null; // Tanggal tidak valid
                                    }
                                } else {
                                    // Jika format sudah YYYY-MM-DD, gunakan langsung
                                    $article->published_at = $article->tanggal_terbit;
                                }
                            } catch (\Exception $e) {
                                $article->published_at = null; // Gagal parsing
                            }
                        } else {
                            $article->published_at = null;
                        }

                        break; // Hentikan loop setelah menemukan artikel
                    }
                }
            }
        }

        // Jika artikel tidak ditemukan di JSON, Anda bisa lempar 404 atau tampilkan pesan
        if (!$article) {
            // throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
            // Atau, untuk demo, bisa buat objek artikel dummy dengan pesan error
            $article = (object) [
                'title' => 'Artikel Tidak Ditemukan',
                'content' => '<p class="text-muted">Maaf, artikel yang Anda cari tidak tersedia.</p>',
                'category' => 'Error',
                'published_at' => now(),
                'thumbnail_url' => null,
            ];
        }
        // --- Bagian Perubahan Utama Berakhir Di Sini ---

        // Kirim objek $article ke view
        return view('content.admin.contents.pages.artikel-view', compact('article', 'pageConfigs'));
    }
}