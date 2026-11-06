<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\GenericUser;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
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

        // 3. Check standard Laravel Auth check
        $isAuth = Auth::check();

        // If user is not authenticated via web guard but session has auth_user_id, attempt to login user
        if (!$isAuth && session()->has('auth_user_id')) {
            Auth::loginUsingId(session('auth_user_id'));
            $isAuth = Auth::check();
        }

        // If user has standard Auth, Authorization header, or session auth_api_token, allow access
        if ($isAuth || $hasAuthHeader || $hasApiToken) {
            return $next($request);
        }

        // Otherwise, user has no authorization -> redirect to landing page
        return $this->unauthenticated($request, $guards);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('encorecustom_com');
    }
}


