<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
use App\Models\ProfilDesa; // ✅ Gunakan Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileDesaController extends Controller
{
    /**
     * Load profile data dari DATABASE.
     * @return array
     */
    private function loadProfileData()
    {
        // Ambil baris pertama dari tabel, atau buat baru jika kosong
        $profil = ProfilDesa::firstOrCreate(
            ['id' => 1],
            ['konten' => []]
        );
        return $profil->konten; // Kembalikan array 'konten'
    }

    /**
     * Helper function untuk set nested array values.
     * Tidak berubah, tapi tetap diperlukan.
     */
    private function setNestedValue(&$arr, $path, $value)
    {
        $keys = explode('.', $path);
        $temp = &$arr;
        foreach ($keys as $key) {
            $temp = &$temp[$key];
        }
        $temp = $value;
    }

    /**
     * Menampilkan halaman admin.
     */
    public function index()
    {
        $pageConfigs = ['myLayout' => 'horizontal'];
        $dataProfil = $this->loadProfileData();

        return view('content.admin.contents.pages.profile-desa', [
            'pageConfigs' => $pageConfigs,
            'dataProfil' => $dataProfil
        ]);
    }

    /**
     * Menampilkan halaman publik.
     */
    public function publicIndex()
    {
        $pageConfigs = ['myLayout' => 'front'];
        $dataProfil = $this->loadProfileData();

        return view('content.public.pages.profile-desa', [
            'pageConfigs' => $pageConfigs,
            'dataProfil' => $dataProfil
        ]);
    }

    /**
     * Update data profil di DATABASE.
     */
    public function update(Request $request)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['superadmin', 'admin-konten'])) {
            return redirect()->back()->with('error', 'Akses tidak diizinkan.');
        }

        $request->validate([
            'profile_data' => 'required|json',
            'image_files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' // Validasi file gambar
        ]);

        $profileData = json_decode($request->input('profile_data'), true);

        // Handle image uploads
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $file) {
                // Nama file di-encode di JS, decode kembali di sini
                $originalFieldKey = str_replace('_', '.', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));

                $currentData = $this->loadProfileData();
                $currentImagePath = data_get($currentData, $originalFieldKey);
                if ($currentImagePath && File::exists(public_path($currentImagePath))) {
                    File::delete(public_path($currentImagePath));
                }

                $uploadPath = 'uploads/profile/';
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path($uploadPath), $fileName);
                $newImagePath = $uploadPath . $fileName;

                // Update array profileData dengan path gambar yang baru
                data_set($profileData, $originalFieldKey, $newImagePath);
            }
        }

        // Simpan data ke database
        ProfilDesa::updateOrCreate(
            ['id' => 1],
            ['konten' => $profileData]
        );

        return redirect()->back()->with('success', 'Profil desa berhasil diperbarui!');
    }
}