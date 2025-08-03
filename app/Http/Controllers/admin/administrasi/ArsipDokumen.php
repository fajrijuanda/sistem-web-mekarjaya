<?php

// app/Http/Controllers/admin/administrasi/ArsipDokumen.php
namespace App\Http\Controllers\admin\administrasi;

use App\Http\Controllers\Controller;
use App\Models\ArsipDokumen as Arsip; // Menggunakan alias 'Arsip'
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArsipDokumen extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) {
            // Untuk initial page load, kirim data untuk filter
            $uniqueCategories = Arsip::select('kategori')->distinct()->pluck('kategori');
            $uniqueYears = Arsip::selectRaw('YEAR(tanggal_unggah) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

            $pageConfigs = ['myLayout' => 'horizontal'];
            return view('content.admin.services.pages.arsip-dokumen', compact('pageConfigs', 'uniqueCategories', 'uniqueYears'));
        }

        // Logika untuk Server-Side DataTables
        $query = Arsip::with('user')->select('arsip_dokumens.*');

        // Filter Kategori
        if ($kategori = $request->input('kategori')) {
            $query->where('kategori', $kategori);
        }

        // Filter Tahun
        if ($tahun = $request->input('tahun')) {
            $query->whereYear('tanggal_unggah', $tahun);
        }

        // Handle Pencarian Global
        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_dokumen', 'LIKE', "%{$search}%")
                    ->orWhere('nomor_dokumen', 'LIKE', "%{$search}%")
                    ->orWhere('kategori', 'LIKE', "%{$search}%");
            });
        }

        $totalFiltered = $query->count();
        $totalData = Arsip::count();

        // Handle Sorting & Pagination
        $orderColumnIndex = $request->input('order.0.column');
        $orderDir = $request->input('order.0.dir', 'desc');
        $columns = [2 => 'nama_dokumen', 3 => 'kategori', 4 => 'tanggal_unggah', 5 => 'ukuran_file'];
        $orderColumn = $columns[$orderColumnIndex] ?? 'tanggal_unggah';

        $documents = $query->offset($request->input('start'))
            ->limit($request->input('length'))
            ->orderBy($orderColumn, $orderDir)
            ->get();

        $data = [];
        foreach ($documents as $doc) {
            $data[] = [
                'id' => $doc->id,
                'nama_dokumen' => $doc->nama_dokumen,
                'nomor_dokumen' => $doc->nomor_dokumen,
                'kategori' => $doc->kategori,
                'tanggal_unggah' => $doc->formatted_tanggal_unggah,
                'ukuran_file' => $doc->formatted_ukuran_file,
                'tipe_file' => $doc->tipe_file,
                'file_url' => $doc->file_url,
                'aksi' => '', // Aksi akan di-render di client-side
            ];
        }

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
            'nomor_dokumen' => 'nullable|string|max:100',
            'kategori' => 'required|string|max:100',
            'tanggal_unggah' => 'required|date',
            'file_dokumen' => 'required|file|mimes:pdf,docx,doc,jpg,jpeg,png,xlsx,xls|max:10240', // Maks 10MB
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $file = $request->file('file_dokumen');
        $namaFileAsli = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $ekstensiFile = $file->getClientOriginalExtension();
        $namaFileUnik = time() . '-' . Str::slug($namaFileAsli) . '.' . $ekstensiFile;

        $file->storeAs('arsip-dokumen', $namaFileUnik, 'public');

        Arsip::create([
            'nama_dokumen' => $request->nama_dokumen,
            'nomor_dokumen' => $request->nomor_dokumen,
            'kategori' => $request->kategori,
            'tanggal_unggah' => $request->tanggal_unggah,
            'nama_file' => $namaFileUnik,
            'tipe_file' => $ekstensiFile,
            'ukuran_file' => $file->getSize(),
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'message' => 'Dokumen berhasil diunggah.']);
    }

    public function show(Arsip $arsip)
    {
        return response()->json([
            'id' => $arsip->id,
            'nama_dokumen' => $arsip->nama_dokumen,
            'nomor_dokumen' => $arsip->nomor_dokumen,
            'kategori' => $arsip->kategori,
            // Format tanggal menjadi YYYY-MM-DD untuk input HTML
            'tanggal_unggah' => $arsip->tanggal_unggah->format('Y-m-d'),
            // Kirim nama file dan URL untuk ditampilkan di view
            'nama_file' => $arsip->nama_file,
            'file_url' => $arsip->file_url,
        ]);
    }

    public function update(Request $request, Arsip $arsip)
    {
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
            'nomor_dokumen' => 'nullable|string|max:100',
            'kategori' => 'required|string|max:100',
            'tanggal_unggah' => 'required|date',
            'file_dokumen' => 'nullable|file|mimes:pdf,docx,doc,jpg,jpeg,png,xlsx,xls|max:10240', // Maks 10MB
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $dataToUpdate = $request->except('file_dokumen');

        if ($request->hasFile('file_dokumen')) {
            Storage::disk('public')->delete('arsip-dokumen/' . $arsip->nama_file);

            $file = $request->file('file_dokumen');
            $namaFileAsli = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ekstensiFile = $file->getClientOriginalExtension();
            $namaFileUnik = time() . '-' . Str::slug($namaFileAsli) . '.' . $ekstensiFile;
            $file->storeAs('arsip-dokumen', $namaFileUnik, 'public');

            $dataToUpdate['nama_file'] = $namaFileUnik;
            $dataToUpdate['tipe_file'] = $ekstensiFile;
            $dataToUpdate['ukuran_file'] = $file->getSize();
        }

        $arsip->update($dataToUpdate);

        return response()->json(['success' => true, 'message' => 'Dokumen berhasil diperbarui.']);
    }

    public function destroy(Arsip $arsip)
    {
        try {
            // Hapus file dari storage
            Storage::disk('public')->delete('arsip-dokumen/' . $arsip->nama_file);

            // Hapus record dari database
            $arsip->delete();

            return response()->json(['success' => true, 'message' => 'Dokumen berhasil dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus dokumen.'], 500);
        }
    }
}