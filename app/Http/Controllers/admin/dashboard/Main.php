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
        // --- DATA STATISTIK YANG DIPERBARUI ---
        $stats = [
            // Layanan (untuk swiper)
            'totalLayanan' => PermohonanLayanan::count(),
            'layananSelesai' => PermohonanLayanan::where('status', 'Selesai')->count(),
            'layananDiproses' => PermohonanLayanan::where('status', 'Diproses')->count(),

            // Kependudukan (untuk swiper)
            'totalPenduduk' => Penduduk::count(),
            'totalKK' => KartuKeluarga::count(),
            'totalPria' => Penduduk::where('jenis_kelamin', 'Laki-laki')->count(),
            'totalWanita' => Penduduk::where('jenis_kelamin', 'Perempuan')->count(),

            // Statistik untuk 4 kartu kecil
            'permohonanMasukBulanIni' => PermohonanLayanan::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
            'permohonanDitolakBulanIni' => PermohonanLayanan::where('status', 'Ditolak')->whereMonth('tanggal_selesai', now()->month)->whereYear('tanggal_selesai', now()->year)->count(),

            // === STATISTIK BARU UNTUK WELCOME BANNER ===
            'artikelMingguIni' => Article::whereBetween('published_date', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'totalPembaca' => Article::sum('views'), // Mengambil total dari kolom 'views'
        ];

        // ... (sisa kode controller Anda tidak perlu diubah) ...
        $komposisiLayanan = KategoriLayanan::withCount('permohonanLayanans')->get();
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
