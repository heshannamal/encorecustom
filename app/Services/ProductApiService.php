<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Exception;

class ProductApiService
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

    public function getMainCategories()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/get_main_categories');

            if ($response->successful()) {
                $responseBody = $response->json();

                // Extract the data array from the response structure
                if (isset($responseBody['main_categories'])) {
                    return $responseBody['main_categories'];
                }

                return [];
            }

            Log::error('ProductApiService::getMainCategories failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProductApiService::getMainCategories exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function getSports()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/get_sports');

            if ($response->successful()) {
                $responseBody = $response->json();

                // Extract the data array from the response structure
                if (isset($responseBody['sports'])) {
                    return $responseBody['sports'];
                }

                return [];
            }

            Log::error('ProductApiService::getSports failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProductApiService::getSports exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    public function getProductCategories()
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/get_product_categories');

            if ($response->successful()) {
                $responseBody = $response->json();

                // Extract the data array from the response structure
                if (isset($responseBody['product_categories'])) {
                    return $responseBody['product_categories'];
                }

                return [];
            }

            Log::error('ProductApiService::getProductCategories failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProductApiService::getProductCategories exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    /**
     * Fetch products from external REST API endpoint
     * URL: http://localhost/Encorecustom_ecomerce/api/v1/get_products?sales_channel_id=1
     */
    public function getProducts(array $filters = []): array
    {
        $queryParams = array_filter($filters, function ($val) {
            return $val !== null && $val !== '';
        });

        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/get_products', $queryParams);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ProductApiService::getProducts failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProductApiService::getProducts exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }

    /**
     * Formats API response into matchingData array expected by shop blade view
     */
    public function formatMatchingData(array $apiResponse): array
    {
        // $alldata = [];

        $items = [];
        if (isset($apiResponse['data']['data']) && is_array($apiResponse['data']['data'])) {
            $items = $apiResponse['data']['data'];
        } elseif (isset($apiResponse['data']) && is_array($apiResponse['data'])) {
            $items = $apiResponse['data'];
        }

        // foreach ($items as $sub) {
        //     $subObject = json_decode(json_encode($sub));
        //     $alldata[] = [
        //         'type' => 'sub_product',
        //         'data' => $subObject,
        //     ];
        // }
        // $alldata = $items;
        shuffle($items);

        return $items;
    }

    public function getProductOptions($id)
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->get($this->baseUrl . '/get_product_options/' . $id);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ProductApiService::getProductOptions failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (Exception $e) {
            Log::error('ProductApiService::getProductOptions exception', [
                'error' => $e->getMessage(),
            ]);
        }

        return [];
    }
}
