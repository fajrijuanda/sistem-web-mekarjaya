<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use App\Models\KategoriLayanan;
use App\Models\KartuKeluarga; // <-- Tambahkan ini
use App\Models\Penduduk;
use App\Models\PermohonanLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // <-- Tambahkan untuk logging error
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PengajuanSuratController extends Controller
{
    /**
     * Menampilkan halaman daftar pilihan jenis surat untuk pengajuan.
     */
    public function index()
    {
        $kategoriLayanan = KategoriLayanan::with('jenisLayanan')
            ->whereHas('jenisLayanan')
            ->get();

        return view('content.public.pages.surat.pengajuan-surat-index', [
            'pageConfigs' => ['myLayout' => 'front'],
            'kategoriLayanan' => $kategoriLayanan,
        ]);
    }

    /**
     * Menampilkan form pengajuan untuk jenis layanan tertentu.
     */
    public function create(JenisLayanan $jenisLayanan)
    {
        return view('content.public.pages.surat.pengajuan-surat-form', [
            'pageConfigs' => ['myLayout' => 'front'],
            'layanan' => $jenisLayanan,
        ]);
    }

    /**
     * Menyimpan permohonan surat baru dari warga (VERSI AJAX).
     */
    public function store(Request $request, JenisLayanan $jenisLayanan)
    {
        // 1. Aturan Validasi (tidak berubah)
        $rules = [
            'nik' => 'required|numeric|digits:16',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date_format:Y-m-d',
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'no_hp' => 'required|string|max:15',
            'nomor_kk' => 'required|numeric|digits:16',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|numeric|digits_between:1,3',
            'rw' => 'required|numeric|digits_between:1,3',
            'keterangan_pemohon' => 'nullable|string',
        ];

        if (!empty($jenisLayanan->syarat_pengajuan)) {
            foreach ($jenisLayanan->syarat_pengajuan as $syarat) {
                $field_name = 'berkas.' . Str::slug($syarat);
                $rules[$field_name] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
            }
        }

        $validator = Validator::make($request->all(), $rules);

        // JIKA VALIDASI GAGAL, KIRIM JSON ERROR
        if ($validator->fails()) {
            // Hentikan redirect, ganti dengan response JSON
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $permohonan = DB::transaction(function () use ($request, $jenisLayanan) {
                // ... (Logika penyimpanan data Anda di sini sudah benar, tidak perlu diubah)
                $kartuKeluarga = KartuKeluarga::firstOrCreate(
                    ['nomor_kk' => $request->input('nomor_kk')],
                    ['alamat' => $request->input('alamat'), 'rt' => $request->input('rt'), 'rw' => $request->input('rw')]
                );
                $penduduk = Penduduk::firstOrCreate(
                    ['nik' => $request->input('nik')],
                    [
                        'kartu_keluarga_id' => $kartuKeluarga->id,
                        'nama_lengkap' => $request->input('nama_lengkap'),
                        'jenis_kelamin' => $request->input('jenis_kelamin'),
                        'tempat_lahir' => $request->input('tempat_lahir'),
                        'tanggal_lahir' => $request->input('tanggal_lahir'),
                        'agama' => $request->input('agama'),
                        'pekerjaan' => $request->input('pekerjaan'),
                    ]
                );
                $kodePermohonan = 'LY-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(4));
                $berkasPaths = [];
                if ($request->hasFile('berkas')) {
                    foreach ($request->file('berkas') as $key => $file) {
                        $path = $file->store("berkas_permohonan/{$kodePermohonan}", 'public');
                        $berkasPaths[$key] = $path;
                    }
                }
                return PermohonanLayanan::create([
                    'kode_permohonan' => $kodePermohonan,
                    'penduduk_id' => $penduduk->id,
                    'jenis_layanan_id' => $jenisLayanan->id,
                    'status' => 'Diajukan',
                    'keterangan_pemohon' => $request->input('keterangan_pemohon'),
                    'form_data' => $request->input('form_data'),
                    'berkas' => $berkasPaths,
                ]);
            });

            // JIKA BERHASIL, KIRIM JSON SUKSES
            return response()->json([
                'message' => "Permohonan untuk {$jenisLayanan->nama_layanan} dengan kode {$permohonan->kode_permohonan} telah berhasil dikirim!",
                'redirect_url' => route('public.pengajuan-surat.index')
            ]);

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan permohonan: ' . $e->getMessage() . ' di baris ' . $e->getLine());

            // JIKA ADA ERROR SERVER, KIRIM JSON ERROR
            return response()->json([
                'message' => 'Terjadi kesalahan pada sistem saat memproses data. Silakan coba lagi.'
            ], 500); // 500 = Internal Server Error
        }
    }
}
