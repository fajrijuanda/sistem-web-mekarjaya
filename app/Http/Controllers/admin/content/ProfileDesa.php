<?php

namespace App\Http\Controllers\admin\content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileDesa extends Controller
{
    private $jsonPath = 'assets/json/profile-desa.json'; // Path relative to public directory

    /**
     * Load profile data from JSON file.
     * @return array
     */
    private function loadProfileData()
    {
        $fullPath = public_path($this->jsonPath);
        if (File::exists($fullPath)) {
            $jsonContent = File::get($fullPath);
            return json_decode($jsonContent, true);
        }
        return []; // Return empty array if file not found
    }

    /**
     * Save profile data to JSON file.
     * @param array $data
     * @return void
     */
    private function saveProfileData(array $data)
    {
        $fullPath = public_path($this->jsonPath);
        // Pastikan direktori ada sebelum menulis file
        File::ensureDirectoryExists(dirname($fullPath));
        File::put($fullPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Helper function to set nested array/object values.
     * @param array $arr
     * @param string $path
     * @param mixed $value
     * @return void
     */
    private function setNestedValue(&$arr, $path, $value)
    {
        $keys = explode('.', $path);
        $temp = &$arr;
        foreach ($keys as $key) {
            if (!isset($temp[$key]) || !is_array($temp[$key])) {
                $temp[$key] = [];
            }
            $temp = &$temp[$key];
        }
        $temp = $value;
    }

    /**
     * Display the admin view of the village profile.
     * Accessible only by authenticated admins.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Pemeriksaan role bisa ditambahkan di sini jika tidak menggunakan middleware role-based
        // if (!Auth::check() || !in_array(Auth::user()->role, ['superadmin', 'admin-konten'])) {
        //     abort(403, 'Unauthorized action.');
        // }

        $pageConfigs = ['myLayout' => 'horizontal'];
        $dataProfil = $this->loadProfileData();

        return view('content.admin.contents.pages.profile-desa', [
            'pageConfigs' => $pageConfigs,
            'dataProfil' => $dataProfil
        ]);
    }

    /**
     * Display the public view of the village profile.
     * Accessible by anyone (guest or logged-in users).
     *
     * @return \Illuminate\Http\Response
     */
    public function publicIndex()
    {
        $pageConfigs = ['myLayout' => 'front']; // Asumsi layout publik berbeda atau tanpa sidebar
        $dataProfil = $this->loadProfileData();

        // Anda mungkin ingin memfilter dataProfil agar hanya menampilkan yang relevan untuk publik
        // Atau pastikan JSON Anda sudah dioptimalkan untuk tampilan publik.

        return view('content.public.pages.profile-desa', [ // Asumsi view publik ada di sini
            'pageConfigs' => $pageConfigs,
            'dataProfil' => $dataProfil
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validasi bahwa hanya admin yang terautentikasi yang bisa update
        // Ini adalah lapisan keamanan BACKEND. Frontend hanya untuk UX.
        // Asumsi middleware 'auth' sudah melindungi route ini.
        // Jika Anda ingin membatasi role tertentu, tambahkan:
        if (!Auth::check() || !in_array(Auth::user()->role, ['superadmin', 'admin-konten'])) {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }

        // Validasi input text/data JSON
        $request->validate([
            'profile_data' => 'required|json', // Pastikan ini adalah JSON string
            // Tambahkan validasi untuk file jika diperlukan (misal: 'image_files.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048')
        ]);

        $profileData = json_decode($request->input('profile_data'), true);

        // Handle image uploads
        if ($request->hasFile('image_files')) {
            foreach ($request->file('image_files') as $fieldPathEncoded => $file) {
                // $fieldPathEncoded adalah nama input file, yang kita asumsikan sudah di-encode dari field path
                // Contoh: hero_image, features_items_0_icon
                $originalFieldKey = str_replace('_', '.', $fieldPathEncoded); // Konversi kembali ke hero.image, features.items.0.icon

                // Hapus gambar lama jika ada dan berbeda
                $currentImagePath = data_get($profileData, $originalFieldKey);
                if ($currentImagePath && File::exists(public_path($currentImagePath))) {
                    File::delete(public_path($currentImagePath));
                }

                $uploadPath = 'uploads/profile/';
                $fileName = time() . '_' . $file->getClientOriginalName(); // Gunakan original name untuk menghindari konflik jika ada file dengan nama sama
                $file->move(public_path($uploadPath), $fileName);
                $newImagePath = $uploadPath . $fileName;

                // Update the profileData array with the new image path
                $this->setNestedValue($profileData, $originalFieldKey, $newImagePath);
            }
        }

        // Save the updated JSON data
        $this->saveProfileData($profileData);

        return redirect()->back()->with('success', 'Profil desa berhasil diperbarui!');
    }
}