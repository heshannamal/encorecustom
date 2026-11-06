<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class USPSService
{
    protected string $baseUrl;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.usps.base_url'), '/');
        $this->clientId = config('services.usps.consumer_key');
        $this->clientSecret = config('services.usps.consumer_secret');
    }

    public function getAccessToken(): string
    {
        return Cache::remember('usps_access_token', now()->addMinutes(430), function () {
            $response = Http::asJson()->post($this->baseUrl . '/oauth2/v3/token', [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]);

            if (!$response->successful()) {
                Log::error('USPS OAuth failed', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                ]);

                throw new Exception('Unable to authenticate with USPS.');
            }

            return $response->json('access_token');
        });
    }

    public function getDomesticRates(array $data): array
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->acceptJson()
            ->asJson()
            ->post($this->baseUrl . '/prices/v3/base-rates/search', $data);

        if (!$response->successful()) {
            Log::error('USPS rate request failed', [
                'status' => $response->status(),
                'body' => $response->json(),
                'payload' => $data,
            ]);

            throw new Exception('Unable to get USPS shipping rates.');
        }

        return $response->json();
    }
    public function createDomesticLabel(array $labelData)
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->acceptJson()
            ->asJson()
            ->post($this->baseUrl . '/labels/v3/label', $labelData);

        if (!$response->successful()) {
            return [
                'status' => 'error',
                'body' => $response->json(),
                'payload' => $labelData,
            ];
        }

        return $response->json();
    }
}
