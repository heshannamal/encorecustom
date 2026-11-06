<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerDetail;
use App\Models\User;
use App\Services\OrderApiService;
use App\Services\ProfileApiService;
use App\Traits\OrderHelper;
use Carbon\Carbon;
use domain\Facades\OrderFacade\OrderFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    use OrderHelper;

    protected $profileApiService;
    protected $orderApiService;

    public function __construct(ProfileApiService $profileApiService , OrderApiService $orderApiService)
    {
        $this->profileApiService = $profileApiService;
        $this->orderApiService = $orderApiService;
    }

    public function profile_view()
    {
        $user = auth()->user();
        $countries = [];
        $getCountriesResponse = $this->profileApiService->getCountries();
        if($getCountriesResponse['success']){
            $countries = $getCountriesResponse['data'];
        }
        return view('pages.customer_end.profile.index', compact('user', 'countries'));
    }

    public function get_customer_details()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401);
        }

        // $customerDetail = $user->customerDetail;
        // if (!$customerDetail) {
        //     $customerDetail = CustomerDetail::create([
        //         'user_id' => $user->id,
        //         'first_name' => explode(' ', $user->name)[0] ?? 'User',
        //         'last_name' => explode(' ', $user->name)[1] ?? '',
        //         'preferred_language' => 'English (US)'
        //     ]);
        // }

        $apiDetails = $this->profileApiService->getCustomerDetails();
        if($apiDetails['success']){
            $customerDetail = $apiDetails['data'];
        }

        $dobFormatted = $customerDetail['date_of_birth'] ? Carbon::parse($customerDetail['date_of_birth'])->format('F d, Y') : 'Not Specified';
        $age = $customerDetail['date_of_birth'] ? Carbon::parse($customerDetail['date_of_birth'])->age : 'N/A';
        $createdAtFormatted = $customerDetail['user_detail']['created_at'] ? Carbon::parse($customerDetail['user_detail']['created_at'])->format('F d, Y') : 'Recently';

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_pic_url' => $user->profile_pic_url,
                    'created_at_formatted' => $createdAtFormatted,
                ],
                'customer_detail' => [
                    'first_name' => $customerDetail['first_name'],
                    'last_name' => $customerDetail['last_name'],
                    'date_of_birth' => $customerDetail['date_of_birth'],
                    'dob_formatted' => $dobFormatted,
                    'age' => $age,
                    'country_id' => $customerDetail['country_id'],
                    'country_name' => $customerDetail['country'] ?? 'Not Specified',
                    'country_code' => $customerDetail['country_code'] ?? 'Global',
                    'country_flag' => $customerDetail['countryDetail']['flag'] ?? '🌐',
                    'preferred_language' => $customerDetail['preferred_language'] ?? 'English (US)',
                    'phone_number' => $customerDetail['phone_number'],
                    'street' => $customerDetail['street'],
                    'address' => $customerDetail['address'],
                    'city' => $customerDetail['city'],
                    'state' => $customerDetail['state'],
                    'postal_code' => $customerDetail['postal_code'],
                ]
            ]
        ]);
    }

    public function update(Request $request)
    {
        $file = null;
        $section = $request->input('section');

        if ($section === 'name') {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
        }

        if ($section === 'dob') {
            $validator = Validator::make($request->all(), [
                'date_of_birth' => 'required|date|before:today',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
        }

        if ($section === 'country') {
            $validator = Validator::make($request->all(), [
                'country_id' => 'required|exists:countries,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
        }

        if ($section === 'language') {
            $validator = Validator::make($request->all(), [
                'preferred_language' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
        }

        if ($section === 'contact') {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email,' . auth()->user()->id,
                'phone_number' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
        }


        if ($section === 'avatar') {
            $validator = Validator::make($request->all(), [
                'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }

            $file = $request->file('profile_pic');
        }

        if ($section === 'address') {
            $validator = Validator::make($request->all(), [
                'address' => 'required|string|max:255',
                'street' => 'nullable|string|max:255',
                'city' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'postal_code' => 'required|string|max:255',
                'phone_number' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
            }
        }

        $apiResponse = $this->profileApiService->updateProfile($request->all(), $file);
        if($apiResponse['success'] && $section === 'name'){
            session()->put('auth_user_name', $apiResponse['data']['full_name']);
            session()->put('auth_user_first_name', $apiResponse['data']['first_name']);
        }
        if($apiResponse['success'] && $section === 'avatar'){
            session()->put('auth_user_profile_pic_url', $apiResponse['data']['profile_pic_url']);
        }
        return response()->json($apiResponse);
    }

    public function order_history()
    {
        $apiResponse = $this->profileApiService->orderSummary();
        $data = $apiResponse['data'] ?? [];
        $data['totalOrders'] = $data['totalOrders'] ?? 0;
        $data['inPacking'] = $data['inPacking'] ?? 0;
        $data['delivered'] = $data['delivered'] ?? 0;
        $data['refundAndCancel'] = $data['refundAndCancel'] ?? 0;
        $data['odHelper'] = $this;
        return view('pages.customer_end.profile.order_history', $data);
    }

    public function get_order_history_data(Request $request)
    {
        $apiResponse = $this->profileApiService->orderHistory($request->all());
        return response()->json($apiResponse);
    }

    public function getOrderById($id)
    {
        $apiResponse = $this->orderApiService->getCustomerOrderById($id);
        $order = $apiResponse['data'];
        $odHelper = $this;
        return view('pages.customer_end.profile.partials.order_details_modal_body', compact('order', 'odHelper'));
    }

    public function getReceiptDetails($id)
    {
        $response = $this->orderApiService->getOrderReceiptDetails($id);
        return response()->json($response);
    }


    public function billing_payments()
    {
        $user = auth()->user();
        $countries = [];
        $getCountriesResponse = $this->profileApiService->getCountries();
        if($getCountriesResponse['success']){
            $countries = $getCountriesResponse['data'];
        }
        
        // $customerDetail = $user->customerDetail;
        // if (!$customerDetail) {
        //     $customerDetail = CustomerDetail::create([
        //         'user_id' => $user->id,
        //         'first_name' => explode(' ', $user->name)[0] ?? 'User',
        //         'last_name' => explode(' ', $user->name)[1] ?? '',
        //         'preferred_language' => 'English (US)'
        //     ]);
        // }
        
        // $orders = $user->orderDetails()
        //     ->with(['paymentMethodDetail'])
        //     ->orderBy('created_at', 'desc')
        //     ->get();

        $odHelper = $this;

        return view('pages.customer_end.profile.billing_payments', compact('user', 'countries', 'odHelper'));
    }

    public function get_order_payment_details()
    {
        $response = $this->profileApiService->getOrderPaymentDetails();
        return response()->json($response);
    }

    public function gift_cards()
    {
        $user = auth()->user();
        $customerDetail = $user->customerDetail;
        return view('pages.customer_end.profile.gift_cards', compact('user', 'customerDetail'));
    }
}

