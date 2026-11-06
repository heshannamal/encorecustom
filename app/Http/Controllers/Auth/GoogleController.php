<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthApiService;
use domain\Facades\UserFacade\CustomerFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    protected AuthApiService $authApiService;

    public function __construct(AuthApiService $authApiService)
    {
        $this->authApiService = $authApiService;
    }

    public function redirectToGoogle(Request $request)
    {
        if ($request->has('ajax')) {
            session(['google_popup' => true]);
        }
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Google OAuth error', ['error' => $e->getMessage()]);
            return redirect('/login')->with('error', 'Failed to authenticate with Google. Please try again.');
        }

        $firstName = $googleUser->user['given_name'] ?? '';
        $lastName  = $googleUser->user['family_name'] ?? '';
        $email     = $googleUser->getEmail();

        // Authenticate via external API
        $apiResponse = $this->authApiService->socialLogin([
            'email'      => $email,
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'is_social'  => 1,
        ]);

        if (!empty($apiResponse['success']) && !empty($apiResponse['data']['token'])) {
            session(['auth_api_token' => $apiResponse['data']['token']]);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            $data['first_name'] = $firstName;
            $data['last_name']  = $lastName;
            $data['email']      = $email;
            $data['inventory_id'] = $apiResponse['data']['user']['inventory_id'] ?? 2;
            $data['is_social']  = 1;
            $user = CustomerFacade::storeCustomer($data);
        }

        if ($user) {
            session(['auth_user_id' => $user->id]);
        }

        Auth::login($user);

        // Merge cart
        $this->mergeCart($user->id);

        \Illuminate\Support\Facades\Log::info('Google callback session check:', [
            'has_google_popup' => session()->has('google_popup'),
            'google_popup_val' => session('google_popup')
        ]);

        if (session('google_popup')) {
            session()->forget('google_popup');
            return view('auth.google_success', [
                'user' => [
                    'first_name' => $user->customerDetail->first_name ?? $user->name,
                    'role' => $user->role ?? 'customer'
                ]
            ]);
        }

        return redirect('/dashboard');
    }

    private function mergeCart($userId)
    {
        if (session()->has('temp_id')) {
            $tempId = session('temp_id');
            \App\Models\Cart::where('temp_id', $tempId)
                ->whereNull('user_id')
                ->update(['user_id' => $userId]);
        }
    }
}
