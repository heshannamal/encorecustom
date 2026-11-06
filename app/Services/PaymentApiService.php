<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class PaymentApiService
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

    public function getPaymentDetails()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/profile/get_payment_details');

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('PaymentApiService::get_payment_details failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('PaymentApiService::get_payment_details exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function updateBillingDetails($formData)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/profile/update_billing_details', $formData);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('PaymentApiService::get_payment_details failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('PaymentApiService::get_payment_details exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

}
