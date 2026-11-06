<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CustomerDetail;
use App\Models\User;
use App\Services\AuthApiService;
use domain\Facades\UserFacade\CustomerFacade;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{
    protected AuthApiService $authApiService;
    protected $defaultInventoryId;

    public function __construct(AuthApiService $authApiService)
    {
        $this->authApiService = $authApiService;
        $this->defaultInventoryId = 2;
    }

    public function ajaxLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }

        // Authenticate via external API
        $apiResponse = $this->authApiService->login($request->email, $request->password);

        if (empty($apiResponse['success']) || empty($apiResponse['data']['token'])) {
            return response()->json([
                'success' => false,
                'message' => $apiResponse['message'] ?? 'Invalid credentials.'
            ], 401);
        }

        $apiToken = $apiResponse['data']['token'];
        $apiUserData = $apiResponse['data']['user'] ?? [];

        // Sync/Find local User record
        // $user = User::where('email', $request->email)->first();

        // if (!$apiUserData) {
        //     $fullName = $apiUserData['name'] ?? 'Customer';
        //     $nameParts = explode(' ', $fullName, 2);
        //     $user = CustomerFacade::storeCustomer([
        //         'first_name' => $nameParts[0],
        //         'last_name' => $nameParts[1] ?? '',
        //         'email' => $request->email,
        //         'password' => $request->password,
        //         'inventory_id' => $apiUserData['inventory_id'] ?? 2,
        //     ]);
        // }

        // Save API token and user ID in session
        session([
            'auth_api_token' => $apiToken,
            'auth_user_id'   => $apiUserData['id'],
            'auth_user_name'   => $apiUserData['name'],
            'auth_user_first_name'   => $apiUserData['first_name'],
            'auth_user_email'   => $apiUserData['email'],
            'auth_user_group_id'   => $apiUserData['user_group_id'],
            'auth_user_inventory_id'   => $apiUserData['inventory_id'],
            'auth_user_profile_pic_url'   => $apiUserData['profile_pic_url'],
        ]);

        $user = new GenericUser([
            'api_token' => $apiToken,
            'id' => $apiUserData['id'],
            'name' => $apiUserData['name'],
            'first_name' => $apiUserData['first_name'],
            'email' => $apiUserData['email'],
            'user_group_id' => $apiUserData['user_group_id'],
            'inventory_id' => $apiUserData['inventory_id'],
            'profile_pic_url' => $apiUserData['profile_pic_url'],
        ]);

        Auth::setUser($user);

        Auth::login($user);
        $this->mergeCart($user->id);

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'user' => [
                'first_name' => $user->first_name,
            ]
        ]);
    }

    public function ajaxRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }

        $data = $request->all();
        $data['inventory_id'] = $this->defaultInventoryId;

        // Register via external API
        $apiResponse = $this->authApiService->register($data);

        if (empty($apiResponse['success']) || empty($apiResponse['data']['token'])) {
            return response()->json([
                'success' => false,
                'message' => $apiResponse['message'] ?? 'Registration failed.'
            ], 422);
        }

        $apiToken = $apiResponse['data']['token'];
        $apiUserData = $apiResponse['data']['user'] ?? [];
        // Sync/Store local User record
        // $user = User::where('email', $request->email)->first();

        // if (!$user) {
        //     $data = $request->all();
        //     $data['first_name'] = $request->f_name;
        //     $data['last_name'] = $request->l_name;
        //     $data['inventory_id'] = $apiUserData['inventory_id'] ?? 2;
        //     $user = CustomerFacade::storeCustomer($data);
        // }

        if (!empty($apiUserData)) {
            // Save API token and user ID in session
            // session([
            //     'auth_api_token' => $apiToken,
            //     'auth_user_id'   => $user->id,
            // ]);

            // Save API token and user ID in session
            session([
                'auth_api_token' => $apiToken,
                'auth_user_id'   => $apiUserData['id'],
                'auth_user_name'   => $apiUserData['name'],
                'auth_user_first_name'   => $apiUserData['first_name'],
                'auth_user_email'   => $apiUserData['email'],
                'auth_user_group_id'   => $apiUserData['user_group_id'],
                'auth_user_inventory_id'   => $apiUserData['inventory_id'],
                'auth_user_profile_pic_url'   => $apiUserData['profile_pic_url'],
            ]);

            $user = new GenericUser([
                'api_token' => $apiToken,
                'id' => $apiUserData['id'],
                'name' => $apiUserData['name'],
                'first_name' => $apiUserData['first_name'],
                'email' => $apiUserData['email'],
                'user_group_id' => $apiUserData['user_group_id'],
                'inventory_id' => $apiUserData['inventory_id'],
                'profile_pic_url' => $apiUserData['profile_pic_url'],
            ]);

            Auth::setUser($user);

            Auth::login($user);
            $this->mergeCart($user->id);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'user' => [
                    'first_name' => $user->first_name,
                ]
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Registration failed.'], 500);
    }

    private function mergeCart($userId)
    {
        if (session()->has('temp_id')) {
            $tempId = session('temp_id');
            Cart::where('temp_id', $tempId)
                ->whereNull('user_id')
                ->update(['user_id' => $userId]);
        }
    }
}
