<?php

namespace App\Traits;

trait InventoryHelper
{
    public function inventory_order_status($status)
    {
        $statusSpan = [
            '<span class="pending_card">Pending</span>',
            '<span class="paid_card">In Stock</span>',
        ];
        return $statusSpan[$status];
    }
}
