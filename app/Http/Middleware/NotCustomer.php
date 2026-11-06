<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotCustomer
{
    /**
     * Handle an incoming request.
     *
     * Blocks access for users whose role is 'customer'.
     * All other authenticated roles (admin, super_admin, staff, etc.) are allowed through.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->hasRole('customer')) {
            // Check if the request is AJAX (XMLHttpRequest)
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied. Customers are not allowed to access that area.'
                ], 403);
            } else {
                return redirect()->route('encorecustom_com')
                ->with('error', 'Access denied. Customers are not allowed to access that area.');
            }
        }

        return $next($request);
    }
}
