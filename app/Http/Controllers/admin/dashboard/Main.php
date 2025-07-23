<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\KategoriLayanan;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Models\PermohonanLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Main extends Controller
{
    /**
     * Menampilkan halaman utama dashboard dengan data statistik.
     */
    public function index()
    {
        // --- Data untuk Kartu Statistik ---
        $stats = [
            // Layanan
            'totalLayanan' => PermohonanLayanan::count(),
            'layananSelesai' => PermohonanLayanan::where('status', 'Selesai')->count(),
            'layananDiproses' => PermohonanLayanan::where('status', 'Diproses')->count(),
            // Kependudukan
            'totalPenduduk' => Penduduk::count(),
            'totalKK' => KartuKeluarga::count(),
            'totalPria' => Penduduk::where('jenis_kelamin', 'Laki-laki')->count(),
            'totalWanita' => Penduduk::where('jenis_kelamin', 'Perempuan')->count(),
            // Konten
            'artikelBulanIni' => Article::whereMonth('published_date', now()->month)->whereYear('published_date', now()->year)->count(),
            'totalArtikel' => Article::count(),
        ];

        // --- Data untuk Grafik Komposisi Layanan (Donut Chart) ---
        $komposisiLayanan = KategoriLayanan::withCount('jenisLayanan as total_permohonan')
            ->get()
            ->map(function ($kategori) {
                // Menghitung jumlah permohonan per kategori
                $kategori->total_permohonan = PermohonanLayanan::whereHas('jenisLayanan', function ($query) use ($kategori) {
                    $query->where('kategori_layanan_id', $kategori->id);
                })->count();
                return $kategori;
            });

        // --- Data untuk Grafik Tren Aktivitas (Line Chart) ---
        $trenData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $bulan = $date->translatedFormat('M');
            $trenData['labels'][] = $bulan;
            $trenData['layanan'][] = PermohonanLayanan::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->count();
            $trenData['artikel'][] = Article::whereMonth('published_date', $date->month)->whereYear('published_date', $date->year)->count();
        }

        return view('content.admin.main.dashboard-main', [
            'pageConfigs' => ['myLayout' => 'horizontal'],
            'stats' => $stats,
            'komposisiLayanan' => $komposisiLayanan,
            'trenData' => $trenData,
        ]);
    }

    /**
     * Menyediakan data untuk tabel Permohonan Layanan Terbaru (DataTables).
     */
    public function latestRequests(Request $request)
    {
        $query = PermohonanLayanan::with(['penduduk', 'jenisLayanan'])
            ->latest() // Urutkan dari yang terbaru
            ->take(20); // Ambil 20 data teratas untuk performa

        // Ini adalah implementasi sederhana, untuk DataTables server-side penuh
        // Anda perlu menambahkan logika search dan pagination.
        $data = $query->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'service_name' => $item->jenisLayanan->nama_layanan,
                'service_type' => $item->jenisLayanan->kategoriLayanan->nama_kategori,
                'applicant_name' => $item->penduduk->nama_lengkap,
                'date' => $item->created_at->format('d M Y'),
                'status' => $item->status,
            ];
        });

        return response()->json(['data' => $data]);
    }
}
