<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    protected $connection = 'mysql';
    protected $table = 'stock_adjustments';

    protected $fillable = [
        'inventory_type_id',
        'product_id',
        'sub_product_id',
        'size_id',
        'color_master_id',
        'quantity',
        'unit_price',
        'reason',
        'created_by',
    ];

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }

    public function color()
    {
        return $this->belongsTo(ColorMaster::class, 'color_master_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function inventoryType()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_type_id');
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
