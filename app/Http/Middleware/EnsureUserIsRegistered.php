<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsRegistered
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Pengguna belum login, redirect ke halaman login
            return redirect()->route('admin')->withErrors('Anda harus login terlebih dahulu.');
        }

        // Pengguna sudah login, lanjutkan ke permintaan berikutnya
        return $next($request);
    }
}
