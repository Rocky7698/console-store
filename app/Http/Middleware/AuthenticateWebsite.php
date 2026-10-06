<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateWebsite
{
    public function handle($request, Closure $next)
    {
        // If user NOT logged in
        if (!Auth::check()) {
            return redirect()->route('website.auth.login');
        }

        return $next($request);
    }
}
