<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use App\Models\KategoriLayanan;
use App\Models\Penduduk;
use App\Models\PermohonanLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
     * Menyimpan permohonan surat baru dari warga.
     */
    public function store(Request $request, JenisLayanan $jenisLayanan)
    {
        // 1. Aturan Validasi Dasar
        $rules = [
            'nik' => 'required|numeric|digits:16',
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'keterangan_pemohon' => 'nullable|string',
        ];

        // 2. Aturan Validasi Dinamis untuk form_data (Surat Nikah)
        // Cek jika ini adalah form untuk surat nikah, lalu tambahkan validasi spesifik
        if ($jenisLayanan->slug === 'surat-pengantar-nikah') { // Ganti 'surat-pengantar-nikah' dengan slug yang sesuai
            $nikah_rules = [
                'form_data.calon_pasangan.nama_lengkap' => 'required|string|max:255',
                'form_data.calon_pasangan.tempat_lahir' => 'required|string|max:100',
                'form_data.calon_pasangan.tanggal_lahir' => 'required|date',
                'form_data.calon_pasangan.pekerjaan' => 'required|string|max:100',
                'form_data.calon_pasangan.tempat_tinggal' => 'required|string',

                'form_data.ayah_pemohon.nama_lengkap' => 'required|string|max:255',
                'form_data.ibu_pemohon.nama_lengkap' => 'required|string|max:255',

                'form_data.info_pernikahan.tanggal' => 'required|date',
                'form_data.info_pernikahan.maskawin' => 'required|string',
            ];
            $rules = array_merge($rules, $nikah_rules);
        }


        // 3. Aturan Validasi Dinamis untuk Berkas
        if (!empty($jenisLayanan->syarat_pengajuan)) {
            foreach ($jenisLayanan->syarat_pengajuan as $syarat) {
                $field_name = 'berkas.' . Str::slug($syarat);
                $rules[$field_name] = 'required|file|mimes:jpg,jpeg,png,pdf|max:2048';
            }
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // 4. Cari atau Buat Data Penduduk berdasarkan NIK
            $penduduk = Penduduk::firstOrCreate(
                ['nik' => $request->nik],
                [
                    'nama_lengkap' => $request->nama_lengkap,
                    'jenis_kelamin' => 'Laki-laki', // Placeholder
                    'tempat_lahir' => 'Tidak Diketahui', // Placeholder
                    'tanggal_lahir' => now(), // Placeholder
                    'agama' => 'Islam', // Placeholder
                    'pekerjaan' => 'Tidak Diketahui', // Placeholder
                    'kartu_keluarga_id' => 1, // Placeholder
                ]
            );

            // 5. Buat Kode Permohonan Unik
            $kodePermohonan = strtoupper(Str::limit($jenisLayanan->slug, 5, '')) . '-' . now()->format('Ymd') . '-' . Str::random(4);

            // 6. Proses Upload Berkas
            $berkasPaths = [];
            if ($request->hasFile('berkas')) {
                foreach ($request->file('berkas') as $key => $file) {
                    $path = $file->store("berkas_permohonan/{$kodePermohonan}", 'public');
                    $berkasPaths[$key] = $path;
                }
            }

            // 7. Simpan Permohonan ke Database
            PermohonanLayanan::create([
                'kode_permohonan' => $kodePermohonan,
                'penduduk_id' => $penduduk->id,
                'jenis_layanan_id' => $jenisLayanan->id,
                'status' => 'Diajukan',
                'keterangan_pemohon' => $request->keterangan_pemohon,
                'form_data' => $request->form_data, // <-- SIMPAN DATA FORM DI SINI
                'berkas' => $berkasPaths,
            ]);

            DB::commit();

            return redirect()->route('public.pengajuan-surat.index')->with('success', "Permohonan untuk {$jenisLayanan->nama_layanan} dengan kode {$kodePermohonan} telah berhasil dikirim!");
        } catch (\Exception $e) {
            DB::rollBack();
            // Tampilkan error untuk debugging jika mode debug aktif
            // return redirect()->back()->with('error', $e->getMessage())->withInput();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim permohonan. Silakan coba lagi.')->withInput();
        }
    }
}