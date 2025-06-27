<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureTokenExists
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('auth_token')) {
            // Redirect ke login kalau token tidak ada
            return redirect('/login');
        }

        return $next($request);
    }
}
