<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPassword extends Controller
{
    // Menampilkan form reset password
    public function showResetForm(Request $request, $token = null)
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-reset-password', [
            'pageConfigs' => $pageConfigs,
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Memproses & menyimpan password baru
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        });

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        return back()->withErrors(['email' => __($status)]);
    }
}