<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password; // <-- Tambahkan ini

class ForgotPassword extends Controller
{
    public function index()
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-forgot-password', ['pageConfigs' => $pageConfigs]);
    }

    // Fungsi untuk mengirim link reset
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Kirim link reset menggunakan fitur bawaan Laravel
        $status = Password::sendResetLink($request->only('email'));

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}