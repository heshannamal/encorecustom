<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SyncApiAuth
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
        // 1. Check for Authorization header in request
        $authHeader = $request->header('Authorization');
        $hasAuthHeader = !empty($authHeader);

        if ($hasAuthHeader) {
            $token = trim(str_replace('Bearer', '', $authHeader));
            if ($token && !session()->has('auth_api_token')) {
                session(['auth_api_token' => $token]);
            }
        }

        // 2. Check for auth_api_token in session
        $hasApiToken = session()->has('auth_api_token') && !empty(session('auth_api_token'));

        if($hasApiToken){
            $apiUserData = [
                        'api_token'        => session('auth_api_token'),
                        'id'               => session('auth_user_id'),
                        'name'             => session('auth_user_name'),
                        'first_name'       => session('auth_user_first_name'),
                        'email'            => session('auth_user_email'),
                        'user_group_id'    => session('auth_user_group_id'),
                        'inventory_id'     => session('auth_user_inventory_id'),
                        'profile_pic_url'  => session('auth_user_profile_pic_url'),
            ];
            $user = new GenericUser($apiUserData);
            Auth::setUser($user);
        }

        return $next($request);
    }
}
