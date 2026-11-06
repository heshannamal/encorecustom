<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthApiService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $apiToken;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.inventory_api.base_url', 'http://localhost/Encorecustom_ecomerce/api/v1'), '/');
        $this->apiKey = config('services.inventory_api.api_key', 'inventory_products_api');
        $this->apiToken = config('services.inventory_api.api_token', '0VpFn7U9tzzhRpfLO2bLRdIoFyVoFe7BBZA68vTK');
    }

    protected function getHeaders(?string $bearerToken = null): array
    {
        $headers = [
            'API-Key'      => $this->apiKey,
            'API-Token'    => $this->apiToken,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ];

        if ($bearerToken) {
            $headers['Authorization'] = 'Bearer ' . $bearerToken;
        }

        return $headers;
    }

    public function login(string $email, string $password): array
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/auth/login', [
                    'email'    => $email,
                    'password' => $password,
                ]);

            return $response->json() ?? [
                'success' => false,
                'message' => 'Invalid API response.',
            ];
        } catch (Exception $e) {
            Log::error('AuthApiService login error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'API connection failed: ' . $e->getMessage(),
            ];
        }
    }

    public function register(array $data): array
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/auth/register', $data);

            return $response->json() ?? [
                'success' => false,
                'message' => 'Invalid API response.',
            ];
        } catch (Exception $e) {
            Log::error('AuthApiService register error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'API connection failed: ' . $e->getMessage(),
            ];
        }
    }

    public function socialLogin(array $data): array
    {
        try {
            $response = Http::withHeaders($this->getHeaders())
                ->post($this->baseUrl . '/auth/social-login', $data);

            return $response->json() ?? [
                'success' => false,
                'message' => 'Invalid API response.',
            ];
        } catch (Exception $e) {
            Log::error('AuthApiService socialLogin error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'API connection failed: ' . $e->getMessage(),
            ];
        }
    }

    public function logout(?string $token = null): array
    {
        try {
            $bearerToken = $token ?? session('auth_api_token');
            if (!$bearerToken) {
                return ['success' => true];
            }

            $response = Http::withHeaders($this->getHeaders($bearerToken))
                ->post($this->baseUrl . '/auth/logout');

            return $response->json() ?? ['success' => true];
        } catch (Exception $e) {
            Log::error('AuthApiService logout error: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
