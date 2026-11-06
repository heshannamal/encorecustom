<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class CartApiService
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

    public function getGlobalCartCount($data)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/get_global_cart_count', $data);
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::get_cart_items failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::get_cart_items exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function addToCart($data)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/add_to_cart', $data);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::add_to_cart failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::add_to_cart exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function globalCartItems($data)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/global_cart_items', $data);
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::global_cart_items failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::global_cart_items exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function getCartItems($data)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/get_cart_items', $data);
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::get_cart_items failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::get_cart_items exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function getCartItemIds()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/profile/get_cart_item_ids');
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::get_cart_item_ids failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::get_cart_item_ids exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function getCartItemById($id)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/get_cart_item_by_id/'.$id);
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::get_cart_items failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::get_cart_items exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function updateCartById($data, $id)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/update_cart_by_id/'.$id, $data);
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::update_cart failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::update_cart exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function updateCart($data, $id)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/update_cart/'.$id, $data);
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::update_cart failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::update_cart exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function removeCartItemById($id)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/remove_cart_item_by_id/'.$id);
            
            if ($response->successful()) {
                return $response->json();
            }

            Log::error('CartApiService::remove_cart_item_by_id failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('CartApiService::remove_cart_item_by_id exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }
}
