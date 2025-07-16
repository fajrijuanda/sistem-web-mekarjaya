<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // <-- Tambahkan ini
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash; // <-- Tambahkan ini
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini
use Illuminate\Validation\ValidationException;

class Register extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-register', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Fungsi untuk menyimpan pengguna baru.
     */
    public function store(Request $request)
    {
        try {
            // 1. Validasi data input dari form
            $request->validate([
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed|min:8',
                'terms' => 'accepted',
            ]);

            $defaultRole = 'user'; // Atur role default sebagai 'user'

            // 2. Buat pengguna baru
            $user = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $defaultRole, // Set peran sebagai 'user'
                'profile_photo_path' => 'avatars/1.png', // Default photo path
                // email_verified_at akan diatur secara kondisional setelah user dibuat
            ]);

            // 3. Atur email_verified_at dan kirim notifikasi berdasarkan role
            if ($user->role === 'user') {
                // Untuk role 'user', biarkan email_verified_at NULL dan kirim verifikasi
                // $user->email_verified_at akan tetap NULL secara default saat create
                $user->sendEmailVerificationNotification();
                $redirectTo = route('verification.notice'); // Arahkan ke halaman verifikasi
            } else {
                // Untuk role selain 'user' (misalnya admin), langsung set terverifikasi
                $user->email_verified_at = Carbon::now();
                $user->save(); // Simpan perubahan email_verified_at
                $redirectTo = '/'; // Atau route dashboard default admin
            }

            // 4. Login pengguna yang baru dibuat
            Auth::login($user);

            // 5. Redirect ke halaman yang sesuai
            return redirect($redirectTo);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed: ' . $e->getMessage())->withInput();
        }
    }
}