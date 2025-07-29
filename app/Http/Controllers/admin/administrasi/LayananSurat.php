<?php

namespace App\Http\Controllers\admin\administrasi;

use App\Http\Controllers\Controller;
use App\Models\PermohonanLayanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\Jc;

class LayananSurat extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        // Statistik untuk card di atas tabel (opsional, tapi bagus untuk ditiru)
        $stats = [
            // Card 1: Permohonan Baru (Total hari ini)
            // Menghitung permohonan dengan status 'Diajukan' yang dibuat HARI INI.
            'baru_hari_ini' => PermohonanLayanan::where('status', 'Diajukan')
                ->whereDate('created_at', today())
                ->count(),

            // Card 2: Masih Diproses (Total saat ini)
            // Menghitung semua permohonan yang statusnya masih 'Diproses'.
            'diproses' => PermohonanLayanan::where('status', 'Diproses')->count(),

            // Card 3: Perlu Tindak Lanjut (Ditolak atau revisi)
            // Menghitung semua permohonan yang statusnya 'Ditolak'.
            'ditolak' => PermohonanLayanan::where('status', 'Ditolak')->count(),

            // Card 4: Selesai (Total bulan ini)
            // Menghitung permohonan 'Selesai' yang tanggal selesainya ada di BULAN dan TAHUN ini.
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
            3 => 'jenis_layanan_id', // Akan di-handle dengan relasi
            4 => 'penduduk_id',      // Akan di-handle dengan relasi
            5 => 'created_at',
            6 => 'status',
        ];

        $totalData = PermohonanLayanan::count();
        $query = PermohonanLayanan::with(['penduduk', 'jenisLayanan']) // Eager loading untuk performa
            ->offset($request->input('start'))
            ->limit($request->input('length'));

        // Handle sorting
        if ($request->has('order')) {
            $orderColumn = $columns[$request->input('order.0.column')];
            $orderDir = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDir);
        }

        // Handle searching
        if (!empty($request->input('search.value'))) {
            $search = $request->input('search.value');
            $query->where(function ($q) use ($search) {
                $q->where('kode_permohonan', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%")
                    ->orWhereHas('penduduk', function ($subq) use ($search) {
                        $subq->where('nama_lengkap', 'LIKE', "%{$search}%")->orWhere('nik', 'LIKE', "%{$search}%");
                    })
                    ->orWhereHas('jenisLayanan', function ($subq) use ($search) {
                        $subq->where('nama_layanan', 'LIKE', "%{$search}%");
                    });
            });
        }

        $permohonanList = $query->get();
        $totalFiltered = !empty($request->input('search.value')) ? $query->count() : $totalData;

        $data = [];
        foreach ($permohonanList as $permohonan) {
            $nestedData['id'] = $permohonan->id;
            $nestedData['kode_permohonan'] = $permohonan->kode_permohonan;
            $nestedData['jenis_layanan'] = $permohonan->jenisLayanan->nama_layanan; // Ambil dari relasi
            $nestedData['pemohon'] = $permohonan->penduduk->nama_lengkap; // Ambil dari relasi
            $nestedData['tanggal_pengajuan'] = $permohonan->created_at->format('d M Y');
            $nestedData['status'] = $permohonan->status;
            // 'action' akan di-render oleh JavaScript
            $data[] = $nestedData;
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $data,
        ]);
    }

    public function show($id): JsonResponse
    {
        // --- UBAH BARIS INI ---
        // Kita tambahkan 'penduduk.kartuKeluarga' untuk memuat relasi secara bersarang
        $permohonan = PermohonanLayanan::with(['penduduk.kartuKeluarga', 'jenisLayanan'])->find($id);

        if (!$permohonan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($permohonan);
    }
    /**
     * Mengupdate status permohonan.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $request->validate(['status' => 'required|in:Diproses,Selesai,Ditolak']);

        $permohonan = PermohonanLayanan::find($id);
        if (!$permohonan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $permohonan->status = $request->status;
        if ($request->status === 'Selesai' || $request->status === 'Ditolak') {
            $permohonan->tanggal_selesai = now();
            // Anda juga bisa menambahkan `catatan_admin` dari request jika ada
            if ($request->has('catatan_admin')) {
                $permohonan->catatan_admin = $request->catatan_admin;
            }
        }
        $permohonan->save();

        return response()->json(['message' => 'Status permohonan berhasil diperbarui!']);
    }


    public function publicIndex()
    {
        $pageConfigs = ['myLayout' => 'front']; // Asumsi layout publik berbeda atau tanpa sidebar

        return view('content.public.pages.layanan-surat', ['pageConfigs' => $pageConfigs]);
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
     * Menyiapkan halaman untuk mencetak surat.
     */
    public function print($id)
    {
        $permohonan = PermohonanLayanan::with(['penduduk.kartuKeluarga', 'jenisLayanan'])->findOrFail($id);

        // Pastikan hanya surat yang sudah 'Selesai' yang bisa dicetak
        if ($permohonan->status !== 'Selesai') {
            return redirect()->route('admin.layanan-surat.index')->with('error', 'Surat hanya bisa dicetak jika statusnya Selesai.');
        }

        // Tentukan view template berdasarkan slug layanan
        $template = 'content.admin.services.printables.' . Str::slug($permohonan->jenisLayanan->slug);

        if (!view()->exists($template)) {
            return redirect()->route('admin.layanan-surat.index')->with('error', 'Template cetak untuk layanan ini tidak ditemukan.');
        }

        return view($template, compact('permohonan'));
    }

    /**
     * Membuat dan mengunduh surat dalam format Word.
     */
    /**
     * Membuat dan mengunduh surat dalam format Word (versi perbaikan).
     */
    public function downloadWord($id)
    {
        $permohonan = PermohonanLayanan::with(['penduduk.kartuKeluarga'])->findOrFail($id);

        if ($permohonan->status !== 'Selesai') {
            return redirect()->back()->with('error', 'Dokumen Word hanya bisa dibuat jika statusnya Selesai.');
        }

        $phpWord = new PhpWord();

        // === PERUBAHAN 1: Mengatur Font Default menjadi Arial ===
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $section = $phpWord->addSection(['marginLeft' => 1417, 'marginRight' => 1417, 'marginTop' => 1417, 'marginBottom' => 1417]);

        // === PERUBAIKAN DI SINI: Menggunakan konstanta Jc::BOTH ===
        $phpWord->addParagraphStyle('pStyle', ['alignment' => Jc::BOTH, 'spaceAfter' => 0, 'lineHeight' => 1.5]);
        $phpWord->addParagraphStyle('pClean', ['spaceAfter' => 0]);

        // Judul
        $section->addText('SURAT PERNYATAAN TIDAK KEBERATAN', ['bold' => true, 'underline' => 'single', 'size' => 12], ['alignment' => 'center', 'spaceAfter' => 0]);
        $section->addText('Nomor: ........................................', null, ['alignment' => 'center']);
        $section->addTextBreak(1);

        // Pihak Pertama
        $section->addText('Yang bertanda tangan dibawah ini:', null, 'pClean');
        $tableStyle = ['borderColor' => 'ffffff', 'borderSize' => 0, 'cellMargin' => 0];
        $fontStyle = ['size' => 12];
        $table = $section->addTable($tableStyle);
        $table->addRow();
        $table->addCell(3000)->addText('Nama', $fontStyle);
        $table->addCell(500)->addText(':', $fontStyle);
        $table->addCell(6000)->addText($permohonan->penduduk->nama_lengkap, $fontStyle);
        $table->addRow();
        $table->addCell(3000)->addText('NIK', $fontStyle);
        $table->addCell(500)->addText(':', $fontStyle);
        $table->addCell(6000)->addText($permohonan->penduduk->nik, $fontStyle);
        $table->addRow();
        $table->addCell(3000)->addText('Tempat/Tanggal Lahir', $fontStyle);
        $table->addCell(500)->addText(':', $fontStyle);
        $table->addCell(6000)->addText($permohonan->penduduk->tempat_lahir . ', ' . \Carbon\Carbon::parse($permohonan->penduduk->tanggal_lahir)->translatedFormat('d F Y'), $fontStyle);
        $table->addRow();
        $table->addCell(3000)->addText('Alamat', $fontStyle);
        $table->addCell(500)->addText(':', $fontStyle);
        $table->addCell(6000)->addText($permohonan->penduduk->kartuKeluarga->alamat, $fontStyle);

        $section->addText('Menyatakan dengan sesungguhnya, bahwa saya tidak keberatan Kartu Keluarga (KK) saya dipergunakan oleh saudara/pihak di bawah ini:', null, 'pStyle');

        // Pihak Kedua
        $table2 = $section->addTable($tableStyle);
        $table2->addRow();
        $table2->addCell(3000)->addText('Nama', $fontStyle);
        $table2->addCell(500)->addText(':', $fontStyle);
        $table2->addCell(6000)->addText($permohonan->form_data['pihak2']['nama'] ?? '-', $fontStyle);
        $table2->addRow();
        $table2->addCell(3000)->addText('NIK', $fontStyle);
        $table2->addCell(500)->addText(':', $fontStyle);
        $table2->addCell(6000)->addText($permohonan->form_data['pihak2']['nik'] ?? '-', $fontStyle);
        $table2->addRow();
        $table2->addCell(3000)->addText('Tempat/Tanggal Lahir', $fontStyle);
        $table2->addCell(500)->addText(':', $fontStyle);
        $table2->addCell(6000)->addText(($permohonan->form_data['pihak2']['tempat_lahir'] ?? '') . ', ' . \Carbon\Carbon::parse($permohonan->form_data['pihak2']['tanggal_lahir'])->translatedFormat('d F Y'), $fontStyle);
        $table2->addRow();
        $table2->addCell(3000)->addText('Alamat', $fontStyle);
        $table2->addCell(500)->addText(':', $fontStyle);
        $table2->addCell(6000)->addText($permohonan->form_data['pihak2']['alamat'] ?? '-', $fontStyle);
        $section->addTextBreak(0);

        // Tujuan
        $section->addText('Adapun tujuan penggunaan tersebut adalah untuk:', null, 'pStyle');
        $section->addText($permohonan->form_data['pernyataan']['isi'] ?? 'Tidak ada keterangan.', ['bold' => false], ['spaceBefore' => 100, 'alignment' => 'both']);
        $section->addTextBreak(1);

        // Penutup
        $section->addText('Demikian pernyaan ini saya buat dengan sebenarnya, apabila pernyataan ini tidak sesuai dengan sebenarnya, saya siap untuk diproses sebagaimana hukum yang berlaku.', null, 'pStyle');
        $section->addTextBreak(1);

        // Tanda Tangan
        $tableSign = $section->addTable($tableStyle);
        $tableSign->addRow();
        $tableSign->addCell(5000)->addText('');
        $cellSign = $tableSign->addCell(4500);
        $cellSign->addText('Telukjambe, ' . \Carbon\Carbon::now()->translatedFormat('d F Y'), null, ['alignment' => 'center', 'spaceAfter' => 0]);
        $cellSign->addText('Yang Membuat Pernyataan,', null, ['alignment' => 'center', 'spaceAfter' => 0]);
        $cellSign->addTextBreak(1);
        $cellSign->addText('Materai 6000', null, ['alignment' => 'center', 'spaceAfter' => 0]);
        $cellSign->addTextBreak(2);
        $cellSign->addText('( ' . strtoupper($permohonan->penduduk->nama_lengkap) . ' )', ['bold' => true, 'underline' => 'single'], ['alignment' => 'center', 'spaceAfter' => 0]);

        $fileName = 'Surat Pernyataan - ' . $permohonan->penduduk->nama_lengkap . '.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;
    }
}
