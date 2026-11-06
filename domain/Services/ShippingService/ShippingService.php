<?php

namespace domain\Services\ShippingService;

use App\Models\Cart;
use App\Models\Shipping;
use App\Services\ShippoService;
use Carbon\Carbon;
use Exception;

class ShippingService
{
    protected $cart;
    protected $shippoService;

    public function __construct(ShippoService $shippoService)
    {
        $this->shippoService = $shippoService;
        $this->cart = new Cart();
    }

    public function getShippingFee($billingData, $totalAmount, $totalWeight)
    {
        try {
            $parcel = [
                'length' => 10,
                'width' => 10,
                'height' => 10,
                'distance_unit' => 'in',
                'weight' => $totalWeight > 0 ? round($totalWeight, 2) : 1,
                'mass_unit' => 'oz',
            ];
            
            if($billingData->is_shipping_address_available == 1){
                $address_to = [
                    'name' => $billingData->shipping_first_name.' ' . $billingData->shipping_last_name,
                    'street1' => $billingData->shipping_street ? $billingData->shipping_address.', '.$billingData->shipping_street : $billingData->shipping_address,
                    'city' => $billingData->shipping_city,
                    'state' => $billingData->shipping_state,
                    'zip' => $billingData->shipping_postal_code,
                    'country' => $billingData->shipping_country,
                    'phone' => $billingData->shipping_phone,
                    'email' => $billingData->shipping_email,
                ];
            }else{
                $address_to = [
                    'name' => $billingData->first_name.' ' . $billingData->last_name,
                    'street1' => $billingData->street ? $billingData->address.', '.$billingData->street : $billingData->address,
                    'city' => $billingData->city,
                    'state' => $billingData->state,
                    'zip' => $billingData->postal_code,
                    'country' => $billingData->country,
                    'phone' => $billingData->phone,
                    'email' => $billingData->email,
                ];
            }

            $address_from = [
                'name' => 'Encore Custom',
                'company' => 'Encore Custom',
                'street1' => '891 4th St.',
                'city' => 'San Rafael',
                'state' => 'CA',
                'zip' => '94901',
                'country' => 'USA',
                'phone' => '+1 888-501-4999',
                'email' => 'info@encorecustom.com',
            ];

            $customsItem = [
                'description' => 'For shipping fee calculation',
                'quantity' => 1,
                'net_weight' => $totalWeight > 0 ? $totalWeight : 1,
                'mass_unit' => 'oz',
                'value_amount' => $totalAmount > 0 ? $totalAmount : 1,
                'value_currency' => 'USD',
                'origin_country' => 'US',
            ];

            $customsDeclaration = $this->shippoService->createCustomsDeclaration([
                'contents_type' => 'MERCHANDISE',
                'contents_explanation' => 'Clothing',
                'non_delivery_option' => 'RETURN',
                'certify' => true,
                'certify_signer' => 'Encore Custom',
                'items' => [$customsItem],
            ]);

            $shipment = $this->shippoService->getShippingFee([
                'address_from' => $address_from,
                'address_to' => $address_to,
                'parcels' => [$parcel],
                'async' => false,
                'carrier_accounts' => [env('CAREER_ACC_ID')],
                'customs_declaration' => $customsDeclaration->object_id,
            ]);

            if (empty($shipment['rates'])) {
                return [
                    'success' => false,
                    'message' => 'No shipping rates available.',
                    'details' => $shipment['messages'] ?? []
                ];
            }

            $rates = collect($shipment['rates'])->sortBy('amount')->values();
            $cheapestRate = $rates->get(1) ?? $rates->first();

            return [
                    'success' => true,
                    'amount' => $cheapestRate['amount'],
                    'currency' => $cheapestRate['currency'],
                    'provider' => $cheapestRate['provider'],
                    'service' => $cheapestRate['servicelevel']['name'],
                    'estimated_days' => $cheapestRate['estimated_days'],
            ];
        
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'No shipping rates available.',
                'details' => $th->getMessage()
            ];
        }
    }
}

