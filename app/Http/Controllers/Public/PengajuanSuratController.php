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
        // ✅ DITAMBAHKAN: Helper untuk mendapatkan slug template dari LayananSurat controller
        // (Anda perlu menyalin method getTemplateSlug dari LayananSurat.php ke controller ini,
        // atau membuatnya dapat diakses secara global, contoh di bawah)
        $templateSlug = $this->getTemplateSlugFromLayanan($jenisLayanan, null); // form_data masih null di sini

        return view('content.public.pages.surat.pengajuan-surat-form', [
            'pageConfigs' => ['myLayout' => 'front'],
            'layanan' => $jenisLayanan,
            'template_slug' => $templateSlug, // ✅ Kirim slug ke view
        ]);
    }

    private function getTemplateSlugFromLayanan(JenisLayanan $jenisLayanan, ?array $formData): ?string
    {
        // Di halaman form, sub_jenis belum ada, jadi kita hanya ambil slug utama.
        // Logika ini bisa diperluas jika form Anda memiliki pilihan sub_jenis.
        $subJenis = $formData['sub_jenis'] ?? null;
        if ($subJenis) {
            return $jenisLayanan->slug . '-' . $subJenis;
        }
        return $jenisLayanan->slug;
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
            'foto_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
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
                        'no_hp' => $request->input('no_hp'),
                    ]
                );
                // 1. Buat permohonan terlebih dahulu untuk mendapatkan ID
                $permohonanAwal = PermohonanLayanan::create([
                    'kode_permohonan' => null, // Dibuat null
                    'penduduk_id' => $penduduk->id,
                    'jenis_layanan_id' => $jenisLayanan->id,
                    'status' => 'Diajukan',
                    'keterangan_pemohon' => $request->input('keterangan_pemohon'),
                    'form_data' => $request->input('form_data'),
                    'berkas' => [], // Kosongkan dulu
                ]);

                // 2. Simpan berkas menggunakan ID permohonan yang baru dibuat
                $berkasPaths = [];
                if ($request->hasFile('foto_ktp')) {
                    $path = $request->file('foto_ktp')->store("berkas_permohonan/{$permohonanAwal->id}", 'public');
                    // Simpan dengan kunci 'foto-ktp' agar konsisten
                    $berkasPaths['foto-ktp'] = $path;
                }

                if ($request->hasFile('berkas')) {
                    foreach ($request->file('berkas') as $key => $file) {
                        $path = $file->store("berkas_permohonan/{$permohonanAwal->id}", 'public');
                        $berkasPaths[$key] = $path;
                    }
                }

                // 3. Update record permohonan dengan path berkas
                if (!empty($berkasPaths)) {
                    $permohonanAwal->berkas = $berkasPaths;
                    $permohonanAwal->save();
                }

                return $permohonanAwal;
            });

            // JIKA BERHASIL, KIRIM JSON SUKSES
            return response()->json([
                'message' => "Permohonan untuk {$jenisLayanan->nama_layanan} telah berhasil dikirim!",
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
