<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcOrder extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'orders';

    public function orderItems()
    {
        return $this->hasMany(EcOrderItem::class, 'order_id', 'id');
    }

    public function inventoryAddedOrder()
    {
        return $this->hasOne(InventoryAddedOrder::class, 'order_id', 'id');
    }
}
