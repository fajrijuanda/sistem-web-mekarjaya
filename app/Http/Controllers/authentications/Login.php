<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
  /**
   * Mengarahkan pengguna yang sudah login ke dashboard yang sesuai.
   * Jika belum login, tampilkan halaman login.
   */
  public function index()
  {
    if (Auth::check()) {
      return $this->redirectBasedOnRole(Auth::user());
    }

    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login', ['pageConfigs' => $pageConfigs]);
  }

  /**
   * Menangani proses autentikasi.
   */
  public function authenticate(Request $request)
  {
    // 1. Validasi input
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    // 2. Coba lakukan login
    if (Auth::attempt($credentials, $request->boolean('remember-me'))) {
      $request->session()->regenerate();

      // 3. Panggil fungsi redirect berdasarkan role
      return $this->redirectBasedOnRole(Auth::user());
    }

    // 4. Jika gagal, kembali ke halaman login dengan pesan error
    return back()->withErrors([
      'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
    ])->onlyInput('email');
  }

  /**
   * Menangani proses logout.
   */
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }

  /**
   * Fungsi helper untuk mengarahkan pengguna berdasarkan role.
   *
   * @param \App\Models\User $user
   * @return \Illuminate\Http\RedirectResponse
   */
  private function redirectBasedOnRole($user)
  {
    $role = $user->role; // Mengambil role dari user yang login

    switch ($role) {
      case 'superadmin':
        return redirect()->route('dashboard-utama');
      case 'admin-pelayanan':
        return redirect()->route('dashboard-pelayanan');
      case 'admin-konten':
        return redirect()->route('dashboard-konten');
      default:
        // Pengalihan default untuk peran lain (misal: 'user') atau jika tidak ada peran
        return redirect('/');
    }
  }
}