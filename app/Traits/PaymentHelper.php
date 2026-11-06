<?php

namespace App\Traits;

trait PaymentHelper
{
    public function notAvailableStockItemNotification($notifyArr)
    {
        $items = collect($notifyArr)->map(function ($data) {
        return '<li>' .
                ($data['available_quantity'] > 0
                    ? 'Only ' . $data['available_quantity'] . ' remaining in stock for ' . $data['product'] . ' in ' . $data['size'] . ' size'
                    : 'No stock available for ' . $data['product'] . ' in ' . $data['size'] . ' size'
                ) .
            '</li>';
        })->implode('');

        return "<ul>{$items}</ul>";
    }
}
