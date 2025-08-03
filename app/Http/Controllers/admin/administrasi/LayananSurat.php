<?php

namespace App\Http\Controllers\admin\administrasi;

use App\Http\Controllers\Controller;
use App\Models\PermohonanLayanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Str;

class LayananSurat extends Controller
{
    /**
     * Menampilkan halaman utama manajemen layanan surat.
     */
    public function index()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $stats = [
            'baru_hari_ini' => PermohonanLayanan::where('status', 'Diajukan')
                ->whereDate('created_at', today())
                ->count(),
            'diproses' => PermohonanLayanan::where('status', 'Diproses')->count(),
            'ditolak' => PermohonanLayanan::where('status', 'Ditolak')->count(),
            'selesai_bulan_ini' => PermohonanLayanan::where('status', 'Selesai')
                ->whereMonth('tanggal_selesai', now()->month)
                ->whereYear('tanggal_selesai', now()->year)
                ->count(),
        ];
        return view('content.admin.services.pages.layanan-surat', compact('pageConfigs', 'stats'));
    }

    /**
     * Menyediakan data untuk server-side DataTable.
     */
    public function list(Request $request): JsonResponse
    {
        $columns = [
            1 => 'id',
            2 => 'kode_permohonan',
            3 => 'jenis_layanan_id',
            4 => 'penduduk_id',
            5 => 'no_hp',
            6 => 'berkas',
            7 => 'created_at',
            8 => 'status',
        ];

        $totalData = PermohonanLayanan::count();
        $query = PermohonanLayanan::with(['penduduk', 'jenisLayanan']);

        // Handle searching
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($q) use ($search) {
                $q->where('kode_permohonan', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhereHas('penduduk', function ($subq) use ($search) {
                        $subq->where('nama_lengkap', 'LIKE', "%{$search}%")
                            ->orWhere('nik', 'LIKE', "%{$search}%")
                            ->orWhere('no_hp', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('jenisLayanan', function ($subq) use ($search) {
                        $subq->where('nama_layanan', 'LIKE', "%{$search}%");
                    });
            });
        }

        $totalFiltered = $query->count();

        // Handle sorting
        if ($request->has('order.0.column')) {
            $orderColumnIndex = $request->input('order.0.column');
            if (isset($columns[$orderColumnIndex])) {
                $orderColumn = $columns[$orderColumnIndex];
                $orderDir = $request->input('order.0.dir');

                // ✅ DITAMBAHKAN: Logika sorting khusus untuk kolom relasi
                if ($orderColumn === 'no_hp') {
                    $query->join('penduduks', 'permohonan_layanans.penduduk_id', '=', 'penduduks.id')
                        ->orderBy('penduduks.no_hp', $orderDir)
                        ->select('permohonan_layanans.*'); // Penting untuk menghindari ambiguitas kolom
                } else {
                    $query->orderBy($orderColumn, $orderDir);
                }
            }
        }

        $permohonanList = $query->offset($request->input('start'))
            ->limit($request->input('length'))
            ->get();

        $data = [];
        foreach ($permohonanList as $permohonan) {
            $nestedData['id'] = $permohonan->id;
            $nestedData['kode_permohonan'] = $permohonan->kode_permohonan;
            $nestedData['jenis_layanan'] = $permohonan->jenisLayanan->nama_layanan;
            $nestedData['pemohon'] = $permohonan->penduduk->nama_lengkap;
            $nestedData['no_hp'] = $permohonan->penduduk->no_hp;
            $nestedData['tanggal_pengajuan'] = $permohonan->created_at->isoFormat('D MMMM YYYY');
            $nestedData['status'] = $permohonan->status;
            $nestedData['berkas'] = $permohonan->berkas;
            $data[] = $nestedData;
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $data,
        ]);
    }

    /**
     * Mengambil detail satu permohonan.
     */
    public function show($id): JsonResponse
    {
        $permohonan = PermohonanLayanan::with(['penduduk.kartuKeluarga', 'jenisLayanan'])->find($id);
        if (!$permohonan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // ✅ PERUBAHAN: Tambahkan slug template ke dalam data JSON yang dikirim ke frontend.
        // Ini membuat backend menjadi satu-satunya sumber kebenaran untuk nama template.
        $permohonan->template_slug = $this->getTemplateSlug($permohonan);

        return response()->json($permohonan);
    }

    /**
     * Mengupdate status atau nomor surat permohonan.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'status' => 'sometimes|in:Diproses,Selesai,Ditolak',
            'kode_permohonan' => 'sometimes|nullable|string|max:255',
            'catatan_admin' => 'nullable|string'
        ]);

        $permohonan = PermohonanLayanan::find($id);
        if (!$permohonan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        if ($request->has('status')) {
            $permohonan->status = $request->status;
            if (in_array($request->status, ['Selesai', 'Ditolak'])) {
                $permohonan->tanggal_selesai = now();
            }
        }

        if ($request->has('kode_permohonan')) {
            $permohonan->kode_permohonan = $request->kode_permohonan;
        }

        if ($request->has('catatan_admin')) {
            $permohonan->catatan_admin = $request->catatan_admin;
        }

        $permohonan->save();
        return response()->json(['message' => 'Permohonan berhasil diperbarui!']);
    }

    /**
     * Menghapus permohonan.
     */
    public function destroy($id): JsonResponse
    {
        $permohonan = PermohonanLayanan::find($id);
        if (!$permohonan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $permohonan->delete();
        return response()->json(['message' => 'Permohonan berhasil dihapus!']);
    }

    /**
     * Menyiapkan halaman untuk mencetak surat (PDF) secara dinamis.
     */
    public function print($id)
    {
        $permohonan = PermohonanLayanan::with(['penduduk.kartuKeluarga', 'jenisLayanan'])->findOrFail($id);
        if ($permohonan->status !== 'Selesai') {
            return redirect()->route('admin.administrasi-layanan-surat')->with('error', 'Surat hanya bisa dicetak jika statusnya Selesai.');
        }

        $templateName = $this->getTemplateSlug($permohonan);
        if (!$templateName) {
            return redirect()->route('admin.administrasi-layanan-surat')->with('error', 'Jenis surat tidak spesifik atau tidak didukung.');
        }

        $templateView = 'content.admin.services.printables.' . $templateName;

        if (!view()->exists($templateView)) {
            return redirect()->route('admin.administrasi-layanan-surat')->with('error', "Template cetak '{$templateName}.blade.php' tidak ditemukan.");
        }

        return view($templateView, compact('permohonan'));
    }

    /**
     * ✅ METHOD INI DIPERBAIKI TOTAL
     * Membuat dan mengunduh surat dalam format Word menggunakan sistem template dinamis.
     */
    public function downloadWord($id)
    {
        $permohonan = PermohonanLayanan::with(['penduduk.kartuKeluarga', 'jenisLayanan'])->findOrFail($id);
        if ($permohonan->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Dokumen Word hanya bisa dibuat jika statusnya Selesai.');
        }

        $templateSlug = $this->getTemplateSlug($permohonan);
        if (!$templateSlug) {
            return redirect()->back()->with('error', "Jenis surat tidak spesifik atau tidak didukung untuk export Word.");
        }

        $templatePath = storage_path("app/templates/{$templateSlug}.docx");
        if (!file_exists($templatePath)) {
            return redirect()->back()->with('error', "Template Word '{$templateSlug}.docx' tidak ditemukan.");
        }

        $templateProcessor = new TemplateProcessor($templatePath);

        $methodName = 'getDataFor' . Str::studly(str_replace('-', '_', $templateSlug));
        if (!method_exists($this, $methodName)) {
            return redirect()->back()->with('error', "Logika untuk jenis surat '{$templateSlug}' belum didefinisikan di Controller.");
        }
        $data = $this->{$methodName}($permohonan);

        // --- PENANGANAN KHUSUS UNTUK TEMPLATE DINAMIS ---
        if ($templateSlug === 'permohonan-pindah-datang') {
            // Isi semua placeholder biasa (termasuk yang sudah dipecah per karakter)
            $templateProcessor->setValues($data);
            // Proses data keluarga yang pindah secara berulang
            $keluargaPindah = $data['keluarga_pindah'] ?? [];
            if (!empty($keluargaPindah)) {
                $values = [];
                foreach ($keluargaPindah as $index => $anggota) {
                    $values[] = ['no' => $index + 1, 'nik' => $anggota['nik'] ?? '-', 'nama' => $anggota['nama'] ?? '-', 'shdk' => $anggota['shdk'] ?? '-', 'masa_berlaku' => '----------'];
                }
                $templateProcessor->cloneRowAndSetValues('nik', $values);
            } else {
                $templateProcessor->cloneRowAndSetValues('nik', [['no' => '1', 'nik' => '-', 'nama' => '-', 'shdk' => '-', 'masa_berlaku' => '-']]);
            }
        } elseif ($templateSlug === 'surat-kuasa') {
            // Isi semua placeholder biasa terlebih dahulu
            $templateProcessor->setValues($data);
            // Clone block untuk data pemberi kuasa yang berulang
            if (isset($data['pemberi_block']) && !empty($data['pemberi_block'])) {
                $templateProcessor->cloneBlock('pemberi_block', 0, true, false, $data['pemberi_block']);
            }
        } else {
            // Logika standar untuk semua surat lainnya
            $templateProcessor->setValues($data);
        }

        $fileName = $permohonan->jenisLayanan->nama_layanan . ' - ' . $permohonan->penduduk->nama_lengkap . '.docx';
        return response()->download($templateProcessor->save(), $fileName)->deleteFileAfterSend(true);
    }


    // ===================================================================
    // HELPER METHODS UNTUK MENYIAPKAN DATA SETIAP SURAT
    // ===================================================================

    /**
     * Helper utama untuk menentukan slug template yang benar.
     */
    private function getTemplateSlug(PermohonanLayanan $permohonan): ?string
    {
        $subJenis = $permohonan->form_data['sub_jenis'] ?? null;
        if ($subJenis) {
            return $permohonan->jenisLayanan->slug . '-' . $subJenis;
        }
        return $permohonan->jenisLayanan->slug;
    }

    private function splitStringForTemplate(string $keyPrefix, ?string $value, int $length): array
    {
        $result = [];
        $characters = str_split($value ?? '');
        for ($i = 0; $i < $length; $i++) {
            $result["{$keyPrefix}_" . ($i + 1)] = $characters[$i] ?? '';
        }
        return $result;
    }
    /**
     * ✅ METHOD MODULAR BARU
     * Mengambil data dasar pemohon dari model Penduduk untuk digunakan kembali.
     */
    private function getBasePendudukData(PermohonanLayanan $permohonan): array
    {
        if (!$permohonan->penduduk) {
            return []; // Menghindari error jika relasi penduduk kosong
        }

        $sapaan = ($permohonan->penduduk->jenis_kelamin === 'Laki-laki') ? 'Bpk.' : 'Ibu';

        return [
            // Data Pemohon
            'nama_pemohon' => $permohonan->penduduk->nama_lengkap,
            'nama_pemohon_upper' => strtoupper($permohonan->penduduk->nama_lengkap),
            'nik_pemohon' => $permohonan->penduduk->nik,
            'ttl_pemohon' => $permohonan->penduduk->tempat_lahir . ', ' . Carbon::parse($permohonan->penduduk->tanggal_lahir)->translatedFormat('d F Y'),
            'jenis_kelamin' => $permohonan->penduduk->jenis_kelamin,
            'agama' => $permohonan->penduduk->agama,
            'bangsa_agama' => 'Indonesia / ' . $permohonan->penduduk->agama,
            'pekerjaan' => $permohonan->penduduk->pekerjaan,
            'alamat_pemohon' => $permohonan->penduduk->kartuKeluarga->alamat ?? '-',
            'sapaan' => $sapaan,
            'nomor_surat' => $permohonan->kode_permohonan ?? '.........',
            'tanggal_surat' => Carbon::now()->translatedFormat('d F Y'),
            'nama_pejabat' => 'NAMA KEPALA DESA',
        ];
    }

    /**
     * ✅ DIKEMBALIKAN & DIMODULARISASI
     * Menyiapkan data untuk template 'pernyataan-tidak-keberatan-akta'.
     */
    private function getDataForPernyataanTidakKeberatanAkta($permohonan): array
    {
        $baseData = $this->getBasePendudukData($permohonan);
        $dataAkta = $permohonan->form_data['akta'] ?? [];

        $specificData = [
            'agama_wn_pemohon' => $baseData['agama'] . ' / Indonesia',
            'nama_anak' => $dataAkta['nama_anak'] ?? '-',
            'ttl_anak' => $dataAkta['ttl_anak'] ?? '-',
            'jenis_kelamin_anak' => $dataAkta['jenis_kelamin_anak'] ?? '-',
            'anak_ke' => $dataAkta['anak_ke'] ?? '-',
            'nama_ttd' => $baseData['nama_pemohon_upper'],
        ];

        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ DIKEMBALIKAN KE VERSI AWAL (SESUAI PERMINTAAN)
     * Menyiapkan data untuk template 'pernyataan-tidak-keberatan-kk'.
     * Nama slug diubah agar konsisten.
     */
    private function getDataForPernyataanTidakKeberatanKk($permohonan): array
    {
        $dataPihak2 = $permohonan->form_data['pihak2'] ?? [];
        $dataPernyataan = $permohonan->form_data['pernyataan_kk'] ?? [];

        return [
            'nomor_surat' => $permohonan->kode_permohonan ?? '-',
            'tanggal_surat' => Carbon::now()->translatedFormat('d F Y'),
            // Pihak 1 dari model
            'nama_pihak_1' => $permohonan->penduduk->nama_lengkap,
            'nik_pihak_1' => $permohonan->penduduk->nik,
            'ttl_pihak_1' => $permohonan->penduduk->tempat_lahir . ', ' . Carbon::parse($permohonan->penduduk->tanggal_lahir)->translatedFormat('d F Y'),
            'alamat_pihak_1' => $permohonan->penduduk->kartuKeluarga->alamat,
            'kk_pihak_1' => $permohonan->penduduk->kartuKeluarga->nomor_kk,
            // Pihak 2 dari form_data
            'nama_pihak_2' => $dataPihak2['nama'] ?? '-',
            'nik_pihak_2' => $dataPihak2['nik'] ?? '-',
            'ttl_pihak_2' => ($dataPihak2['tempat_lahir'] ?? '-') . ', ' . (isset($dataPihak2['tanggal_lahir']) ? Carbon::parse($dataPihak2['tanggal_lahir'])->translatedFormat('d F Y') : '-'),
            'alamat_pihak_2' => $dataPihak2['alamat'] ?? '-',
            'tujuan_pernyataan' => $dataPernyataan['isi'] ?? '-',
            'nama_ttd' => strtoupper($permohonan->penduduk->nama_lengkap)
        ];
    }

    /**
     * ✅ DIMODULARISASI
     * Menyiapkan data untuk template 'surat-keterangan-belum-menikah'.
     */
    private function getDataForSuratKeteranganBelumMenikah($permohonan): array
    {
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];

        $specificData = [
            'status_perkawinan' => ($baseData['jenis_kelamin'] === 'Laki-laki') ? 'Jejaka' : 'Perawan',
            'keperluan' => $formData['keperluan'] ?? 'sebagaimana mestinya',
        ];

        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ DIMODULARISASI
     * Menyiapkan data untuk template 'pembuatan-paspor'.
     */
    private function getDataForPembuatanPaspor($permohonan): array
    {
        $baseData = $this->getBasePendudukData($permohonan);

        $rt = $permohonan->penduduk->kartuKeluarga->rt ?? '...';
        $rw = $permohonan->penduduk->kartuKeluarga->rw ?? '...';

        $specificData = [
            'pengantar_rt_rw' => "RT {$rt}/RW {$rw}",
            'nama_keluarga_pengaku' => $baseData['sapaan'] . ' ' . $baseData['nama_pemohon_upper'],
        ];

        return array_merge($baseData, $specificData);
    }


    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'surat-sudah-menikah'.
     */
    private function getDataForSuratSudahMenikah($permohonan): array
    {
        // 1. Ambil data dasar pemohon (suami)
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];

        // 2. Ambil data spesifik dari form_data
        $dataIstri = $formData['istri'] ?? [];
        $detailNikah = $formData['detail_nikah'] ?? [];

        // 3. Siapkan data spesifik untuk digabungkan
        $specificData = [
            'nama_istri' => $dataIstri['nama_lengkap'] ?? '-',
            'ttl_istri' => ($dataIstri['tempat_lahir'] ?? '-') . ', ' . (isset($dataIstri['tanggal_lahir']) ? Carbon::parse($dataIstri['tanggal_lahir'])->translatedFormat('d F Y') : '-'),
            'jenis_kelamin_istri' => 'Perempuan', // Diasumsikan istri selalu perempuan
            'alamat_istri' => $dataIstri['alamat'] ?? '-',
            'wali_nikah' => $detailNikah['wali_nikah'] ?? '-',
            'maskawin' => $detailNikah['maskawin'] ?? '-',
            'saksi_1' => $formData['saksi_1_nama'] ?? '-',
            'saksi_2' => $formData['saksi_2_nama'] ?? '-',
            'nama_suami_upper' => $baseData['nama_pemohon_upper'], // Menggunakan data dari base
            'nama_istri_upper' => strtoupper($dataIstri['nama_lengkap'] ?? '-'),
        ];

        // 4. Gabungkan data dasar dan data spesifik
        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'surat-tidak-mampu'.
     */
    private function getDataForSuratTidakMampu($permohonan): array
    {
        // 1. Ambil data dasar pemohon
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];

        // 2. Logika untuk menentukan nama penanda tangan (Ybs)
        $penggunaType = $formData['pengguna_type'] ?? 'Diri Sendiri';
        $namaTandaTangan = $baseData['nama_pemohon_upper']; // Default-nya adalah pemohon sendiri

        if ($penggunaType === 'Keluarga Lain') {
            $dataPengguna = $formData['pengguna'] ?? [];
            // Jika "Keluarga Lain" dipilih, gunakan nama dari form
            $namaTandaTangan = strtoupper($dataPengguna['nama'] ?? $baseData['nama_pemohon_upper']);
        }

        // 3. Siapkan data spesifik untuk surat ini
        $specificData = [
            'nama_kk' => $baseData['nama_pemohon'], // Diasumsikan pemohon adalah kepala keluarga
            'keperluan' => $formData['keperluan'] ?? '-',
            'nama_tandatangan_pemohon' => $namaTandaTangan,

            // Placeholder untuk bagian Camat (dibiarkan kosong untuk diisi manual)
            'camat_nomor' => '..............................',
            'camat_tanggal' => '..............................',
            'camat_tercatat' => '..............................',
            'camat_nip' => '..............................',
        ];

        // 4. Gabungkan data dasar dan data spesifik
        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'surat-domisili'.
     */
    private function getDataForSuratDomisili($permohonan): array
    {
        // 1. Ambil data dasar pemohon
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];

        // 2. Siapkan data spesifik untuk surat ini dari form_data
        $specificData = [
            'keperluan' => $formData['keperluan'] ?? '-',
            'saksi_1_nama' => $formData['saksi_1_nama'] ?? '-',
            'saksi_1_jabatan' => $formData['saksi_1_jabatan'] ?? '-',
            'saksi_2_nama' => $formData['saksi_2_nama'] ?? '-',
            'saksi_2_jabatan' => $formData['saksi_2_jabatan'] ?? '-',
        ];

        // 3. Gabungkan data dasar dan data spesifik
        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'surat-domisili-usaha'.
     */
    private function getDataForSuratDomisiliUsaha($permohonan): array
    {
        // 1. Ambil data dasar penanggung jawab
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];

        // 2. Format data tanggal dari form (jika ada)
        $imbTanggal = !empty($formData['imb_tanggal']) ? Carbon::parse($formData['imb_tanggal'])->translatedFormat('d F Y') : '-';
        $aktaTanggal = !empty($formData['akta_tanggal']) ? Carbon::parse($formData['akta_tanggal'])->translatedFormat('d F Y') : '-';

        // 3. Siapkan data spesifik untuk surat ini
        $specificData = [
            'nama_perusahaan' => $formData['nama_perusahaan'] ?? '-',
            'jenis_usaha' => $formData['jenis_usaha'] ?? '-',
            'alamat_usaha' => $formData['alamat_usaha'] ?? '-',
            'jumlah_karyawan' => ($formData['jumlah_karyawan'] ?? '-') . ' Orang',
            'penanggung_jawab' => $baseData['nama_pemohon_upper'],

            // Data legalitas digabung agar lebih mudah di template Word
            'imb' => 'Nomer : ' . ($formData['imb_nomor'] ?? '-') . ', Tanggal : ' . $imbTanggal,
            'akta' => 'Notaris : ' . ($formData['akta_notaris_nama'] ?? '-') . ', Nomer : ' . ($formData['akta_nomor'] ?? '-') . ', Tanggal : ' . $aktaTanggal,
        ];

        // 4. Gabungkan data dasar dan data spesifik
        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'surat-keterangan-usaha'.
     */
    private function getDataForSuratKeteranganUsaha($permohonan): array
    {
        // 1. Ambil data dasar pemohon
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];

        // 2. Ambil data spesifik dari sub-array 'usaha' di form_data
        $dataUsaha = $formData['usaha'] ?? [];

        // 3. Siapkan data spesifik untuk surat ini
        $specificData = [
            'nama_usaha' => $dataUsaha['nama_usaha'] ?? '-',
            'usaha_sampingan' => $dataUsaha['usaha_sampingan'] ?? '-',
            'alamat_usaha' => $dataUsaha['alamat_usaha'] ?? '-',
        ];

        // 4. Gabungkan data dasar dan data spesifik
        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'permohonan-pindah-datang'.
     * Catatan: Data untuk template Word akan membutuhkan penanganan khusus
     * karena TemplateProcessor tidak mendukung cloning baris dinamis secara default.
     * Method ini difokuskan untuk pratinjau Blade.
     */
    private function getDataForPermohonanPindahDatang($permohonan): array
    {
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];
        $dataAsal = $formData['asal'] ?? [];
        $dataTujuan = $formData['tujuan'] ?? [];
        $keluargaPindah = $formData['keluarga_pindah'] ?? [];

        $specificData = [
            'provinsi_nama' => 'JAWA BARAT',
            'kabupaten_nama' => 'BEKASI',
            'kecamatan_nama' => 'KEDUNGWARINGIN',
            'desa_nama' => 'MEKARJAYA',
            'dusun_nama' => $dataAsal['dusun'] ?? 'N/A',
            'asal_nama_kk' => $dataAsal['nama_kk'] ?? '-',
            'asal_alamat' => $dataAsal['alamat'] ?? '-',
            'asal_rt' => $dataAsal['rt'] ?? '-',
            'asal_rw' => $dataAsal['rw'] ?? '-',
            'tujuan_alasan' => $dataTujuan['alasan'] ?? '-',
            'tujuan_alamat' => $dataTujuan['alamat'] ?? '-',
            'tujuan_rt' => $dataTujuan['rt'] ?? '-',
            'tujuan_rw' => $dataTujuan['rw'] ?? '-',
            'keluarga_pindah' => $keluargaPindah,
        ];

        $kodeProvinsi = '32';
        $kodeKabupaten = '16';
        $kodeKecamatan = '12';
        $kodeDesa = '2004';
        $provChars = $this->splitStringForTemplate('prov', $kodeProvinsi, 2);
        $kabChars = $this->splitStringForTemplate('kab', $kodeKabupaten, 2);
        $kecChars = $this->splitStringForTemplate('kec', $kodeKecamatan, 2);
        $desaChars = $this->splitStringForTemplate('desa', $kodeDesa, 4);
        $nikPemohonChars = $this->splitStringForTemplate('nik_pemohon', $baseData['nik_pemohon'], 16);
        $noKkChars = $this->splitStringForTemplate('asal_no_kk', $dataAsal['no_kk'], 16);
        $kodePosAsalChars = $this->splitStringForTemplate('asal_kodepos', $dataAsal['kode_pos'], 5);
        $kodePosTujuanChars = $this->splitStringForTemplate('tujuan_kodepos', $dataTujuan['kode_pos'], 5);

        return array_merge($baseData, $specificData, $provChars, $kabChars, $kecChars, $desaChars, $nikPemohonChars, $noKkChars, $kodePosAsalChars, $kodePosTujuanChars);
    }


    // --- Daftar Method untuk Setiap Jenis Surat ---

    private function getDataForSuratKuasa($permohonan): array
    {
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];
        $pihak1Tambahan = $formData['pihak1'] ?? [];
        $dataPihak2 = $formData['pihak2'] ?? [];
        $dataKuasa = $formData['kuasa'] ?? [];
        $dataKendaraan = $formData['kendaraan'] ?? [];

        $pemberiKuasaArray = [];
        $pemberiKuasaArray[] = [
            'no' => 1,
            'pemberi_nama' => strtoupper($baseData['nama_pemohon']),
            'pemberi_nik' => $baseData['nik_pemohon'],
            'pemberi_alamat' => $baseData['alamat_pemohon'],
        ];

        if (!empty($pihak1Tambahan)) {
            foreach ($pihak1Tambahan as $index => $pemberi) {
                $pemberiKuasaArray[] = [
                    'no' => $index + 2,
                    'pemberi_nama' => strtoupper($pemberi['nama'] ?? '-'),
                    'pemberi_nik' => $pemberi['nik'] ?? '-',
                    'pemberi_alamat' => $pemberi['alamat'] ?? '-',
                ];
            }
        }

        $specificData = [
            'pemberi_block' => $pemberiKuasaArray,
            'pihak2_nama' => $dataPihak2['nama'] ?? '-',
            'pihak2_ttl' => ($dataPihak2['tempat_lahir'] ?? '-') . ', ' . (isset($dataPihak2['tanggal_lahir']) ? Carbon::parse($dataPihak2['tanggal_lahir'])->translatedFormat('d F Y') : '-'),
            'pihak2_pekerjaan' => $dataPihak2['pekerjaan'] ?? '-',
            'pihak2_alamat' => $dataPihak2['alamat'] ?? '-',
            'kuasa_tujuan' => $dataKuasa['tujuan'] ?? '-',
            'kendaraan_merk_tipe' => $dataKendaraan['merk_tipe'] ?? '-',
            'kendaraan_tahun_cc' => $dataKendaraan['tahun_cc'] ?? '-',
            'kendaraan_warna' => $dataKendaraan['warna'] ?? '-',
            'kendaraan_no_polisi' => $dataKendaraan['no_polisi'] ?? '-',
            'kendaraan_no_rangka' => $dataKendaraan['no_rangka'] ?? '-',
            'kendaraan_no_mesin' => $dataKendaraan['no_mesin'] ?? '-',
            'kendaraan_no_bpkb' => $dataKendaraan['no_bpkb'] ?? '-',
        ];

        return array_merge($baseData, $specificData);
    }


    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'pengantar-skck'.
     */
    private function getDataForPengantarSkck($permohonan): array
    {
        // 1. Ambil data dasar pemohon
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];

        // 2. Siapkan data spesifik untuk surat ini
        $specificData = [
            'keperluan' => $formData['keperluan'] ?? '-',
        ];

        // 3. Gabungkan data dasar dan data spesifik
        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'tanah-tidak-sengketa'.
     */
    private function getDataForTanahTidakSengketa($permohonan): array
    {
        // 1. Ambil data dasar pemohon (pemilik tanah)
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];

        // 2. Ambil data spesifik dari form_data
        $dataObjek = $formData['objek'] ?? [];
        $dataSaksi1 = $formData['saksi_1'] ?? [];
        $dataSaksi2 = $formData['saksi_2'] ?? [];

        // 3. Hitung umur dari tanggal lahir
        $umur = Carbon::parse($permohonan->penduduk->tanggal_lahir)->age;

        // 4. Siapkan data spesifik untuk surat ini
        $specificData = [
            'umur_pemohon' => $umur . ' Tahun',
            'objek_jenis_tanah' => $dataObjek['jenis_tanah'] ?? 'Tanah Sawah',
            'objek_lokasi' => $dataObjek['lokasi'] ?? '-',
            'objek_sppt' => $dataObjek['sppt'] ?? '-',
            'objek_blok' => $dataObjek['blok'] ?? '-',
            'objek_luas' => $dataObjek['luas'] ?? '-',
            'objek_nama_tercatat' => strtoupper($dataObjek['nama_tercatat'] ?? '-'),
            'dasar_kepemilikan' => strtoupper($dataObjek['dasar_kepemilikan'] ?? '-'), // Data baru
            'batas_utara' => $dataObjek['batas_utara'] ?? '-',
            'batas_timur' => $dataObjek['batas_timur'] ?? '-',
            'batas_selatan' => $dataObjek['batas_selatan'] ?? '-',
            'batas_barat' => $dataObjek['batas_barat'] ?? '-',

            // Menggabungkan nama dan jabatan saksi
            'saksi_1' => ($dataSaksi1['jabatan'] ?? '') . ' ' . ($dataSaksi1['nama'] ?? '-'),
            'saksi_2' => ($dataSaksi2['jabatan'] ?? '') . ' ' . ($dataSaksi2['nama'] ?? '-'),
        ];

        // 5. Gabungkan data dasar dan data spesifik
        return array_merge($baseData, $specificData);
    }

    /**
     * ✅ TAMBAHKAN METHOD BARU INI
     * Menyiapkan data untuk template 'keterangan-riwayat-tanah'.
     */
    private function getDataForKeteranganRiwayatTanah($permohonan): array
    {
        // 1. Ambil data dasar
        $baseData = $this->getBasePendudukData($permohonan);
        $formData = $permohonan->form_data ?? [];
        $tanahSekarang = $formData['tanah_sekarang'] ?? [];
        $riwayat = $formData['riwayat'] ?? [];

        // 2. Logika cerdas untuk mengambil data dari array riwayat
        $pemilikPertama = (isset($riwayat[0]) && !empty($riwayat[0]['nama']))
            ? strtoupper($riwayat[0]['nama'])
            : '..............................';

        $tanggalPertama = (isset($riwayat[0]) && !empty($riwayat[0]['tanggal']))
            ? Carbon::parse(str_replace('-', '/', $riwayat[0]['tanggal']))->translatedFormat('d F Y')
            : '..............................';

        $keteranganTransaksi = '';
        if (isset($riwayat[1])) {
            $transaksi = $riwayat[1];
            $keteranganTransaksi = ($transaksi['jenis'] ?? '') . ' kepada "' . strtoupper($transaksi['nama'] ?? '-') . '"' .
                (!empty($transaksi['keterangan']) ? ' berdasarkan ' . $transaksi['keterangan'] : '');
        }

        // 3. Bangun blok teks untuk daftar riwayat (untuk di Word)
        $riwayatBlock = '';
        if (!empty($riwayat)) {
            foreach ($riwayat as $index => $item) {
                $riwayatBlock .= ($index + 1) . ". Tanggal " . ($item['tanggal'] ?? '-') . " " . ($item['jenis'] ?? '-') . ' "' . strtoupper($item['nama'] ?? '-') . '"' .
                    (!empty($item['keterangan']) ? ", " . $item['keterangan'] : '') . ".\n";
            }
        }

        // 4. Siapkan data spesifik
        $specificData = [
            'dasar_pengecekan' => $tanahSekarang['dasar_pengecekan'] ?? '-',
            'nomor_c' => $tanahSekarang['nomor_c'] ?? '-',
            'luas' => $tanahSekarang['luas'] ?? '-',
            'nama_tercatat' => strtoupper($tanahSekarang['nama_tercatat'] ?? '-'),
            'status_hak' => $tanahSekarang['status_hak'] ?? '-',
            'lokasi_tanah' => $tanahSekarang['lokasi'] ?? '-',
            'sppt' => $tanahSekarang['sppt'] ?? '-',
            'batas_utara' => $tanahSekarang['batas_utara'] ?? '-',
            'batas_timur' => $tanahSekarang['batas_timur'] ?? '-',
            'batas_selatan' => $tanahSekarang['batas_selatan'] ?? '-',
            'batas_barat' => $tanahSekarang['batas_barat'] ?? '-',
            'riwayat_pemilik_pertama' => $pemilikPertama,
            'riwayat_sejak_tanggal' => $tanggalPertama,
            'riwayat_keterangan_transaksi' => trim($keteranganTransaksi),
            'riwayat_block' => trim($riwayatBlock),
            'riwayat_array' => $riwayat,
        ];

        // 5. Gabungkan semua data
        return array_merge($baseData, $specificData);
    }
}