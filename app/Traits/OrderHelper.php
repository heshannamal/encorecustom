<?php

namespace App\Traits;

use Carbon\Carbon;
use domain\Facades\OrderFacade\OrderFacade;

trait OrderHelper
{
    // public function getAllOrdersCount()
    // {
    //     $orderCount = OrderFacade::getAllOrdersCount();
    //     return sprintf('%02d', $orderCount);
    // }

    public function order_number($id)
    {
        return sprintf('%04d', $id);
    }

    public function order_date($date, $format)
    {
        return Carbon::parse($date)->format($format);
    }

    public function payment_status($status)
    {
        $statusSpan = [
            '<span class="withdrawn_card">Not Paid</span>',
            '<span class="paid_card">Paid</span>',
            '<span class="unfulfilled_card">Partially Paid</span>',
            '<span class="withdrawn_card">Refunded</span>',
        ];
        return $statusSpan[$status];
    }

    public function fulfillment_status($status)
    {
        $statusSpan = [
            '<span class="unfulfilled_card">Unfulfilled</span>',
            '<span class="paid_card">Fulfilled</span>'
        ];
        return $statusSpan[$status];
    }

    public function getOrderAddress($order)
    {
        $address = $order['shipping_address'] ? $order['shipping_address'].',' : '';
        $street = $order['shipping_street'] ? $order['shipping_street'].',' : '';
        $city = $order['shipping_city'] ? $order['shipping_city'].',' : '';
        $state = $order['shipping_state'] ? $order['shipping_state'].',' : '';
        $postal_code = $order['shipping_postal_code'] ? $order['shipping_postal_code'].',' : '';
        $country = $order['shipping_country'];
        $phone = $order['shipping_phone'] ? $order['shipping_phone'].',' : '';
        return '<address>'.$address.' '.$street.'</address><address>'.$city.' '.$state.'</address><address>'.$postal_code.' '.$country.'</address><address>'.$phone.'</address>';
    }
}
