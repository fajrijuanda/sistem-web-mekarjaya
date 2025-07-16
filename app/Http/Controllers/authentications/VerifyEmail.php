<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use App\Models\User; // Pastikan ini diimpor jika belum

class VerifyEmail extends Controller
{
    public function index(Request $request)
    {
        $pageConfigs = ['myLayout' => 'blank'];

        // Jika user yang login BUKAN role 'user' atau sudah terverifikasi, redirect ke dashboard
        if ($request->user()->role !== 'user' || $request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard-analytics'));
        }

        // Tentukan waktu sisa untuk resend
        $resend_cooldown = 240; // Detik (4 menit)
        $last_resend_time = Session::get('last_resend_time_' . Auth::id(), 0);
        $time_since_last_resend = time() - $last_resend_time;
        $remaining_time = $resend_cooldown - $time_since_last_resend;

        $remaining_time = max(0, $remaining_time);

        return view('content.authentications.auth-verify-email', [
            'pageConfigs' => $pageConfigs,
            'userEmail' => Auth::user()->email,
            'remainingTime' => $remaining_time,
            'resendCooldown' => $resend_cooldown
        ]);
    }

    /**
     * Handle the email verification link.
     */
    public function verify(EmailVerificationRequest $request)
    {
        // Pastikan user yang memverifikasi email memang role 'user'
        if ($request->user()->role !== 'user') {
            Auth::logout(); // Log out user yang mencoba memverifikasi role non-user
            return redirect('/login')->with('error', 'Only "user" accounts require email verification.');
        }

        $request->fulfill();

        return redirect()->intended(route('profile-desa'))->with('success', 'Your email has been successfully verified!');
    }

    /**
     * Resend the email verification notification.
     */
    public function resend(Request $request)
    {
        // Hanya izinkan role 'user' untuk melakukan resend
        if ($request->user()->role !== 'user') {
            return back()->with('error', 'Only "user" accounts can resend verification emails.');
        }

        $resend_cooldown = 240; // Detik (4 menit)
        $last_resend_time_key = 'last_resend_time_' . Auth::id();
        $last_resend_time = Session::get($last_resend_time_key, 0);

        if (time() - $last_resend_time < $resend_cooldown) {
            $remaining_time = $resend_cooldown - (time() - $last_resend_time);
            throw ValidationException::withMessages([
                'email' => ['Please wait ' . $remaining_time . ' seconds before resending the verification email.'],
            ]);
        }

        // Panggil metode sendEmailVerificationNotification dari model User
        $request->user()->sendEmailVerificationNotification();

        // Simpan timestamp resend terakhir
        Session::put($last_resend_time_key, time());

        return back()->with('success', 'Verification link sent!');
    }
}