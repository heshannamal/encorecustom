<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PosAccess
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        $allowed =
            $user && (
                ($user->inventory_id == 5 && $user->user_group_id == 2) ||
                $user->hasRole('super_admin') ||
                $user->can('manage pos')
            );

        if (!$allowed) {
            Auth::logout();

            return redirect()->route('pos.login')
                ->with('error', 'Access denied to POS system.');
        }

        return $next($request);
    }
}
