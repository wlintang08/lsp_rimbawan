<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // jika belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // jika role tidak sesuai → STOP saja
        if (Auth::user()->role !== $role) {
            abort(403); // jangan redirect lagi
        }

        return $next($request);
    }
}