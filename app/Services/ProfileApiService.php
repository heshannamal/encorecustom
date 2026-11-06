<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class ProfileApiService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $apiToken;
    protected int $inventoryTypeId;
    protected int $salesChannelId;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.inventory_api.base_url', 'http://localhost/Encorecustom_ecomerce/api/v1'), '/');
        $this->apiKey = config('services.inventory_api.api_key', 'inventory_products_api');
        $this->apiToken = config('services.inventory_api.api_token', '0VpFn7U9tzzhRpfLO2bLRdIoFyVoFe7BBZA68vTK');
        $this->inventoryTypeId = (int) config('services.inventory_api.inventory_type_id', 2);
        $this->salesChannelId = (int) config('services.inventory_api.sales_channel_id', 1);
    }

    /**
     * Get default headers required for external API requests
     */
    protected function getHeaders(): array
    {
        $headers = [
            'API-Key' => $this->apiKey,
            'API-Token' => $this->apiToken,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Inventory-Type-Id' => $this->inventoryTypeId,
            'Sales-Channel-Id' => $this->salesChannelId,
        ];

        // Maintain authorization & Laravel auth() session context with external API
        if (session()->has('auth_api_token') && !empty(session('auth_api_token'))) {
            $headers['Authorization'] = 'Bearer ' . session('auth_api_token');
        }

        if (Auth::check()) {
            $user = Auth::user();
            $headers['X-User-Id'] = (string) $user->id;
            $headers['X-User-Email'] = (string) $user->email;
        }

        return $headers;
    }

    public function orderSummary()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/profile/order_summary');

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ProfileApiService::order_summary failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProfileApiService::order_summary exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function orderHistory($data = [])
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/profile/order_history', $data);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ProfileApiService::order_history failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProfileApiService::order_history exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function getCustomerDetails()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/profile/get_customer_details');

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ProfileApiService::get_customer_details failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProfileApiService::get_customer_details exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function getCountries()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/get_countries');

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ProfileApiService::get_countries failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProfileApiService::get_countries exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function updateProfile($data = [], $file = null)
    {
        try {
            if ($file) {
                $headers = $this->getHeaders();

                // Don't manually set Content-Type when using multipart/form-data
                unset($headers['Content-Type']);

                $request = Http::withHeaders($headers);

                // Attach profile picture
                    $request->attach(
                        'profile_pic',
                        file_get_contents($file->getRealPath()),
                        $file->getClientOriginalName()
                    );

                // Send normal form fields
                $formData = [];

                foreach ($data as $key => $value) {
                    if ($key !== 'profile_pic' && !is_null($value)) {
                        $formData[$key] = $value;
                    }
                }

                $response = $request->post(
                    $this->baseUrl . '/profile/update_profile',
                    $formData
                );
            }else{
                $response = Http::withHeaders($this->getHeaders())
                    ->post($this->baseUrl . '/profile/update_profile', $data);
            }

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ProfileApiService::update_profile failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getOrderPaymentDetails($data = [])
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/profile/get_order_payment_details');

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ProfileApiService::get_order_payment_details failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProfileApiService::get_order_payment_details exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

}
