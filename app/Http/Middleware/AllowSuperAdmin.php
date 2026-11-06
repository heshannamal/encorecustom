<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AllowSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * This middleware allows users with the 'super_admin' role
     * to bypass all permission and role checks.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // The actual authorization bypass is handled in AppServiceProvider
        // This middleware just ensures the user context is available
        return $next($request);
    }
}

