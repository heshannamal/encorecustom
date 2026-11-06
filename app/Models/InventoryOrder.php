<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryOrder extends Model
{
    protected $connection = 'mysql';
    protected $table = 'inventory_orders';
    
    protected $fillable = [
        'inventory_type_id',
        'type',
        'ec_order_id',
        'description',
        'status',
        'created_by',
    ];

    public function inventoryType()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_type_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function ecOrder()
    {
        return $this->belongsTo(Order::class, 'ec_order_id');
    }

    public function inventoryOrderItems()
    {
        return $this->hasMany(InventoryOrderItem::class, 'inventory_order_id', 'id');
    }
}
