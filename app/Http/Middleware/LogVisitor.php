<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin/*') && !Auth::check()) {
            $ipAddress = $request->ip();
            $today = now()->toDateString();

            // Coba buat record baru, abaikan jika sudah ada (karena unique key)
            Visitor::query()->firstOrCreate(
                [
                    'ip_address' => $ipAddress,
                    'visit_date' => $today,
                ],
                [
                    'user_agent' => $request->userAgent(),
                ]
            );
        }

        return $next($request);
    }
}