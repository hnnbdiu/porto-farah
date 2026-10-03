<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->email === config('app.admin_email')) {
            return $next($request);
        }

        abort(403, 'Unauthorized access.');
    }
}
