<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function get_base64_image()
    {
        $firstImage = "Product Master/PRO-1/mockup/front.jpg";
        $assetUrl = ec_asset($firstImage);
        
        // Fix 1: Properly encode the URL (handle spaces)
        $imagePath = str_replace(' ', '%20', $assetUrl);
        
        // Fix 2: mime_content_type() doesn't work with URLs. 
        // We need to fetch the file content first.
        $imageDataContent = @file_get_contents($imagePath);
        
        if ($imageDataContent === false) {
            return response()->json([
                'success' => false,
                'message' => "Could not fetch image from: {$imagePath}. Ensure allow_url_fopen is enabled and the URL is accessible."
            ]);
        }

        // Fix 3: Use finfo to get the mime type from the buffer
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($imageDataContent);
        
        $imageData = base64_encode($imageDataContent);
        
        $base64_image = "data:{$mimeType};base64,{$imageData}";
        echo "<img src='{$base64_image}' width='100' alt=''>";
        dd($base64_image);
        // dd();
    }

    public function test_order_customer_mail($orderID)
    {
        email_Notify()->sendEmailFromTemplate('key_order_confirmation_customer', [
                    'orderId' => $orderID,
                ]);
        dd('mail sent');

        $order = Order::with([
                'orderItems.subProductDetail',
                'orderItems.colorDetail',
                'orderItems.sizeDetail',
                'userDetails',
                'paymentMethodDetail',
                'shippingMethodDetail',
                'orderBillingDetail',
                'orderPaymentDetail'
            ])->find($orderID);

        // Format shipping address
        $shippingAddress = '';
        if ($order->orderBillingDetail) {
            $ob = $order->orderBillingDetail;
            if ($ob->is_shipping_address_available == 1) {
                $shippingAddress = ($ob->shipping_first_name ?? '') . ' ' . ($ob->shipping_last_name ?? '') . '<br>' .
                                    ($ob->shipping_address ?? '') . ($ob->shipping_street ? ', ' . $ob->shipping_street : '') . '<br>' .
                                    ($ob->shipping_city ?? '') . ', ' . ($ob->shipping_state ?? '') . ' ' . ($ob->shipping_postal_code ?? '') . '<br>' .
                                    ($ob->shipping_country ?? '') . '<br>Phone: ' . ($ob->shipping_phone ?? $ob->shipping_phone_number ?? '');
            } else {
                $shippingAddress = ($ob->first_name ?? '') . ' ' . ($ob->last_name ?? '') . '<br>' .
                                    ($ob->address ?? '') . ($ob->street ? ', ' . $ob->street : '') . '<br>' .
                                    ($ob->city ?? '') . ', ' . ($ob->state ?? '') . ' ' . ($ob->postal_code ?? '') . '<br>' .
                                    ($ob->country ?? '') . '<br>Phone: ' . ($ob->phone ?? $ob->phone_number ?? '');
            }
        } else {
            $shippingAddress = ($order->userDetails->name ?? '') . '<br>' .
                                ($order->shipping_address ?? '') . ($order->shipping_street ? ', ' . $order->shipping_street : '') . '<br>' .
                                ($order->shipping_city ?? '') . ', ' . ($order->shipping_state ?? '') . ' ' . ($order->shipping_postal_code ?? '') . '<br>' .
                                ($order->shipping_country ?? '') . '<br>Phone: ' . ($order->shipping_phone ?? '');
        }
            
        // Add values to replacements
        $replacements = [
            'order' => $order,
            'orderItems' => $order->orderItems,
            'orderNo' => sprintf('%04d', $order->id),
            'customerName' => $order->orderBillingDetail ? ($order->orderBillingDetail->first_name . ' ' . $order->orderBillingDetail->last_name) : ($order->userDetails->name ?? 'Customer'),
            'customerEmail' => $customerEmail ?? 'N/A',
            'paymentMethod' => $order->paymentMethodDetail->name ?? 'Credit Card',
            'shippingMethod' => $order->shippingMethodDetail->name ?? 'Standard Shipping',
            'date' => $order->created_at->format('d M Y, h:i a'),
            'transactionId' => $order->orderPaymentDetail->transaction_id ?? 'N/A',
            'subTotal' => number_format($order->sub_total, 2),
            'tax' => number_format($order->sales_tax, 2),
            'shipping' => number_format($order->shipping_fee, 2),
            'otherFees' => number_format($order->other_fee, 2),
            'discount' => number_format($order->discount_amount, 2),
            'amountToPay' => number_format($order->invoice_total, 2),
            'paidAmount' => number_format($order->paid_amount, 2),
            'processingFee' => number_format($order->processing_fee, 2),
            'totalPaid' => number_format(($order->orderPaymentDetail->paid_amount ?? $order->paid_amount), 2),
            'shippingAddress' => $shippingAddress,
        ];

        return view('pages.email_templates.order_confirmation_customer_template', $replacements);
    }
}
