<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryOrderItem extends Model
{
    protected $connection = 'mysql';
    protected $table = 'inventory_order_items';
    
    protected $fillable = [
        'inventory_order_id',
        'product_id',
        'sub_product_id',
        'size_id',
        'color_master_id',
        'inventory_type_id',
        'qty',
        'unit_price',
        'created_by',
    ];

    public function inventoryOrder()
    {
        return $this->belongsTo(InventoryOrder::class, 'inventory_order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(ColorMaster::class, 'color_master_id');
    }

    public function inventoryType()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_type_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
