<?php

namespace domain\Services\ShippingService;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\ShippingLabel;
use App\Services\USPSService;
use App\Traits\OrderHelper;
use Carbon\Carbon;
use Exception;

class USPShippingService
{

    use OrderHelper;

    protected $cart;
    protected $order;
    protected $order_items;
    protected $shipping_label;
    protected $uspsService;
    protected $mailClass = 'USPS_GROUND_ADVANTAGE';


    public function __construct(USPSService $uspsService)
    {
        $this->uspsService = $uspsService;
        $this->cart = new Cart();
        $this->order = new Order();
        $this->order_items = new OrderItem();
        $this->shipping_label = new ShippingLabel();
    }

    public function getShippingFee($billingData, $totalAmount, $totalWeight)
    {
        try {
            $totalWeightOz = $totalWeight > 0 ? round($totalWeight, 2) : 1;
            $totalWeightLb = $this->convertOzToLb($totalWeightOz);

            if($billingData->is_shipping_address_available == 1){
                $postalCode = $billingData->shipping_postal_code;
            }else{
                $postalCode = $billingData->postal_code;
            }

            $payload = $this->buildUspsPayload(
                $postalCode,
                $totalWeightLb
            );

            $result = $this->uspsService->getDomesticRates($payload);

            $rates = $this->formatUspsRates($result, $this->mailClass);

            if ($rates->isEmpty()) {
                // return response()->json([
                //     'success' => false,
                //     'message' => 'No USPS shipping rates available.',
                //     'details' => $result,
                // ]);
                return [
                    'success' => false,
                    'message' => 'No USPS shipping rates available.',
                    'details' => $result,
                ];
            }

            $cheapestRate = $rates->first();

            // return response()->json([
            //     'success' => true,
            //     'rate' => [
            //         'amount' => $cheapestRate['amount'],
            //         'currency' => $cheapestRate['currency'],
            //         'provider' => $cheapestRate['provider'],
            //         'service' => $cheapestRate['service'],
            //         'estimated_days' => $cheapestRate['estimated_days'],
            //     ],
            //     'customsItem' => null,
            //     'weight_oz' => $totalWeightOz,
            //     'weight_lb' => $totalWeightLb,
            //     'rates' => $rates,
            //     'usps_payload' => $payload,
            // ]);

            return [
                    'success' => true,
                    'amount' => $cheapestRate['amount'],
                    'currency' => $cheapestRate['currency'],
                    'provider' => $cheapestRate['provider'],
                    'service' => $cheapestRate['service'],
                    'estimated_days' => $cheapestRate['estimated_days'],
            ];

        } catch (\Exception $e) {
            // return response()->json([
            //     'success' => false,
            //     'message' => $e->getMessage(),
            // ]);
            return [
                'success' => false,
                'message' => 'No shipping rates available.',
                'details' => $e->getMessage()
            ];
        }
    }

    private function buildUspsPayload($destinationZip, $weightLb)
    {
        return [
            'originZIPCode' => config('services.usps.origin_zip', '94901'),
            'destinationZIPCode' => $destinationZip,
            'weight' => $weightLb,

            // Apparel parcel dimensions
            'length' => 14,
            'width' => 12,
            'height' => 4,

            // Single mail class only
            'mailClass' => $this->mailClass,

            'processingCategory' => 'MACHINABLE',
            'destinationEntryFacilityType' => 'NONE',
            'rateIndicator' => 'SP',
            'priceType' => 'COMMERCIAL',
        ];
    }

    private function formatUspsRates($result, $defaultMailClass)
    {
        return collect($result['rates'] ?? $result['rateOptions'] ?? $result ?? [])
            ->filter(function ($rate) {
                return isset($rate['price']) || isset($rate['totalBasePrice']) || isset($rate['amount']);
            })
            ->map(function ($rate) use ($defaultMailClass) {
                $mailClass = $rate['mailClass'] ?? $defaultMailClass;

                return [
                    'amount' => (float) ($rate['price'] ?? $rate['totalBasePrice'] ?? $rate['amount']),
                    'currency' => 'USD',
                    'provider' => 'USPS',
                    'service' => $rate['productName'] ?? $rate['description'] ?? $mailClass,
                    'mailClass' => $mailClass,
                    'estimated_days' => $this->getUspsEstimatedDays($mailClass),
                ];
            })
            ->sortBy('amount')
            ->values();
    }

    private function convertOzToLb($weightOz)
    {
        $weightLb = round($weightOz / 16, 2);

        if ($weightLb <= 0) {
            return 1;
        }

        return $weightLb;
    }

    private function freeShippingResponse()
    {
        return response()->json([
            'success' => true,
            'rate' => [
                'amount' => 0.00,
                'currency' => 'USD',
                'provider' => 'USPS',
                'service' => 'N/A',
                'estimated_days' => 'N/A',
            ]
        ]);
    }

    private function getUspsEstimatedDays($mailClass)
    {
        switch ($mailClass) {
            case 'PRIORITY_MAIL_EXPRESS':
                return '1-2 Days';

            case 'PRIORITY_MAIL':
                return '1-3 Days';

            case 'USPS_GROUND_ADVANTAGE':
                return '2-5 Days';

            default:
                return 'N/A';
        }
    }

    public function create_shipping_label($orderId)
    {
        $order = $this->order->with(['orderItems.productDetail'])
            ->where('id', $orderId)
            ->first();

        // if (empty($shipment_id) || empty($selectedRate)) {
        //     return redirect()->back()->with('error', 'Shipment ID or Selected Rate is missing.');
        // }

        // $store_shipment = StoreShipment::where('shipment_id', $shipment_id)->first();

        // if (!$store_shipment) {
        //     return redirect()->back()->with('error', 'Store shipment record not found.');
        // }

        // $order = StoreOrder::with('OrderItems')
        //     ->where('order_no', $store_shipment->store_order_no)
        //     ->first();

        // if (!$order) {
        //     return redirect()->back()->with('error', 'Order not found.');
        // }

        // $totalPrice = 0;
        $totalWeightOz = 0;
        // $totalQty = 0;

        foreach ($order->orderItems as $item) {
            $product = $item->productDetail;

            if (!$product) {
                throw new \Exception('Incomplete product details found.');
            }

            $qty = (int) $item->qty ?: 0;
            $itemWeightOz = (float) ($product->shipping_weight ?: 0);
            // $unitPrice = (float) (
            //     $product->default_price + $product->priceAdditions->sum('addition_amount')
            // );
            // $itemTotalPrice = $unitPrice * $qty;

            // $totalPrice += $itemTotalPrice;
            $totalWeightOz += $itemWeightOz * $qty;
            // $totalQty += $qty;
        }

        $totalWeightOz = round($totalWeightOz > 0 ? $totalWeightOz : 1, 2);
        $totalWeightLb = round($totalWeightOz / 16, 2);

        if ($totalWeightLb <= 0) {
            $totalWeightLb = 1;
        }

        $shippingName = $order->customerDetails->first_name . ' ' . $order->customerDetails->last_name;
        $destinationZip = $order->shipping_postal_code;

        if (empty($destinationZip)) {
            throw new \Exception('Destination ZIP code is required.');
        }

        $payload = [
            'originZIPCode' => config('services.usps.origin_zip', '94901'),
            'destinationZIPCode' => $destinationZip,
            'weight' => $totalWeightLb,
            'length' => 14,
            'width' => 12,
            'height' => 4,
            'mailClass' => $this->mailClass,
            'processingCategory' => 'MACHINABLE',
            'destinationEntryFacilityType' => 'NONE',
            'rateIndicator' => 'SP',
            'priceType' => 'COMMERCIAL',
        ];

        $result = $this->uspsService->getDomesticRates($payload);

        $rates = $this->formatUspsRates($result, $this->mailClass);

        if ($rates->isEmpty()) {
            throw new \Exception('No USPS shipping rates available.');
        }

        $selectedRate = $rates->first();

        $shipmentId = 'USPS-' . $this->order_number($order->id) . '-' . time();

        // =================== Checking shipment Is done Now Creating the label ==============================

        $labelPayload = [
            'imageInfo' => [
                'imageType' => 'PDF',
            ],

            'fromAddress' => [
                'firstName' => 'Encore',
                'lastName' => 'Custom',
                'firm' => 'Encore Custom',
                'streetAddress' => '891 4th St.',
                'city' => 'San Rafael',
                'state' => 'CA',
                'ZIPCode' => '94901',
                'country' => 'US',
                'phone' => '+18885014999',
                'email' => 'info@encorecustom.com',
            ],

            'toAddress' => [
                'firstName' => $order->customerDetails->first_name ?? '',
                'lastName' => $order->customerDetails->last_name ?? '',
                'streetAddress' => $order->shipping_street ? $order->shipping_address.', '.$order->shipping_street : $order->shipping_address,
                'city' => $order->shipping_city,
                'state' => $order->shipping_state,
                'ZIPCode' => $order->shipping_postal_code,
                'country' => $order->shipping_country ?? 'US',
                'phone' => $order->customerDetails->phone ?? '',
                'email' => $order->userDetails->email ?? '',
            ],

            'packageDescription' => [
                'mailClass' => $selectedRate ?: $this->mailClass,
                'rateIndicator' => 'SP',
                'processingCategory' => 'MACHINABLE',
                'weightUOM' => 'lb',
                'weight' => $totalWeightLb,
                'dimensionsUOM' => 'in',
                'length' => 14,
                'width' => 12,
                'height' => 4,
                'customerReference' => $this->order_number($order->id),
                'mailingDate' => date('Y-m-d'),
                'contentType' => 'MERCHANDISE',
            ],
        ];

        $transaction = $this->uspsService->createDomesticLabel($labelPayload);
        $labelUrl = $transaction['labelImage'] ?? $transaction['labelUrl'] ?? null;
        $trackingNumber = $transaction['trackingNumber'] ?? null;

        if (empty($labelUrl)) {
            throw new \Exception('Label PDF not found in USPS response.');
        }

        if (empty($trackingNumber)) {
            throw new \Exception('Tracking number not found in USPS response.');
        }

        $store_shipment = $this->shipping_label;
        $store_shipment->order_id = $order->id;
        $store_shipment->order_no = $this->order_number($order->id);
        $store_shipment->shipping_name = $shippingName;
        $store_shipment->carrier = 'USPS';
        $store_shipment->shipment_id = $shipmentId;
        $store_shipment->selected_rate = $selectedRate['mailClass'];
        $store_shipment->rate = $selectedRate['amount'];
        $store_shipment->service = $selectedRate['service'];
        $store_shipment->estimated_days = $selectedRate['estimated_days'];
        // $store_shipment->is_shipping_removed = $order->is_shipping_removed ?? 0;
        $store_shipment->tracking_object_id = $transaction['labelMetadata']['labelID'] ?? $shipmentId;
        $store_shipment->tracking_number = $trackingNumber;
        $store_shipment->tracking_url = 'https://tools.usps.com/go/TrackConfirmAction?tLabels=' . $trackingNumber;
        $store_shipment->label_url = $labelUrl;
        $store_shipment->save();

        // $controller = new StoreController();
        // $controller->send_store_tracking_email($store_shipment->store_order_no);

        return $store_shipment;
    }
}