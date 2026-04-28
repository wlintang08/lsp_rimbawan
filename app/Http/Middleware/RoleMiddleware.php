<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // jika belum login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // jika role tidak sesuai
        if (!in_array(Auth::user()->role, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}