<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterStock extends Model
{
    protected $connection = 'mysql';
    protected $table = 'master_stocks';

    protected $fillable = [
        'product_id',
        'sub_product_id',
        'size_id',
        'color_master_id',
        'inventory_type_id',
        'stock_qty',
        'unit_price',
        'is_active',
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
}
