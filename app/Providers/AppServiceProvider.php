<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Allow super_admin role to bypass all authorization checks
        Gate::before(function ($user, $ability) {
            if ($user && method_exists($user, 'hasRole') && $user->hasRole('super_admin')) {
                return true;
            }
        });

        // View::composer('*', function ($view) {

        //     $cartCount = 0;

        //     // if(auth()->check()) {
        //     //     $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
        //     // } elseif(session()->has('temp_id')) {
        //     //     $cartCount = Cart::where('temp_id', session('temp_id'))->sum('quantity');
        //     // }

        //     $cartCount = Cart::where('is_purchased', 0)->where(function($qry){
        //         $qry->where('temp_id', session('temp_id'));
        //         if(auth()->check()){
        //             $qry->orWhere('user_id', auth()->id());
        //         }
        //     })->count();

        //     $view->with('globalCartCount', $cartCount);
        // });
    }
}
