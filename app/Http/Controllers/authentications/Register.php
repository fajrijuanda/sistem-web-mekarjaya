<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // <-- Tambahkan ini
use Illuminate\Support\Facades\Hash; // <-- Tambahkan ini
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

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
        // 1. Validasi data input dari form
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'terms' => 'accepted',
        ]);

        // 2. Buat pengguna baru
        $user = User::create([
            'name' => $request->username, // Sesuaikan 'name' dengan nama kolom di tabel Anda
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // <-- Secara otomatis set peran sebagai 'user'
        ]);

        // 3. Login pengguna yang baru dibuat
        Auth::login($user);

        // 4. Redirect ke halaman dashboard
        return redirect('/');
    }
}