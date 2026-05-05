<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login atau bukan admin, redirect ke halaman login
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('admin.login')
                ->withErrors(['username' => 'Silakan login terlebih dahulu.']);
        }

        return $next($request);
    }
}