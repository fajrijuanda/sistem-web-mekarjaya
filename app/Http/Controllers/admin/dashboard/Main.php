<?php

namespace App\Http\Controllers\admin\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\KategoriLayanan;
use App\Models\KartuKeluarga;
use App\Models\Penduduk;
use App\Models\PermohonanLayanan;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Main extends Controller
{
    /**
     * Menampilkan halaman utama dashboard dengan data statistik.
     */
    public function index()
    {
        $pengunjungBulanIni = Visitor::whereMonth('visit_date', now()->month)
            ->whereYear('visit_date', now()->year)
            ->count();

        $pengunjungBulanLalu = Visitor::whereMonth('visit_date', now()->subMonth()->month)
            ->whereYear('visit_date', now()->subMonth()->year)
            ->count();

        if ($pengunjungBulanLalu > 0) {
            $persentasePerubahan = (($pengunjungBulanIni - $pengunjungBulanLalu) / $pengunjungBulanLalu) * 100;
        } else {
            $persentasePerubahan = $pengunjungBulanIni > 0 ? 100 : 0;
        }


        // --- DATA STATISTIK YANG DIPERBARUI ---
        $stats = [
            // Layanan (untuk swiper)
            'totalArtikel' => Article::count(),
            'totalKategoriArtikel' => Article::whereNotNull('category')->distinct()->count('category'),
            'totalPengguna' => User::count(),
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
            'totalPembaca' => Article::sum('views'),
            'totalPengunjung' => Visitor::count(), // Total pengunjung unik sepanjang waktu
            'pengunjungBulanIni' => $pengunjungBulanIni,
            'persentasePerubahanPengunjung' => $persentasePerubahan,
        ];

        $pembacaPerKategori = Article::select(
            // Ganti nilai NULL pada kolom 'category' menjadi 'Tanpa Kategori'
            DB::raw("COALESCE(category, 'Tanpa Kategori') as category"),
            DB::raw('SUM(views) as total_views')
        )
            ->where('views', '>', 0)
            ->groupBy('category') // Tetap group by alias 'category'
            ->orderBy('total_views', 'desc')
            ->get();

        $popularCategories = Article::select('category', DB::raw('SUM(views) as total_views'))
            ->whereNotNull('category')
            ->groupBy('category')
            ->orderBy('total_views', 'desc')
            ->limit(5) // Ambil 5 teratas
            ->get();

        $latestArticles = Article::with('user')->latest('published_date')->take(5)->get();        // ... (sisa kode controller Anda tidak perlu diubah) ...
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
            'trenData' => $trenData,
            'latestArticles' => $latestArticles,
            'pembacaPerKategori' => $pembacaPerKategori,
            'popularCategories' => $popularCategories,
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
