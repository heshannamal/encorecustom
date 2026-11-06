<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransactionLog extends Model
{
    protected $fillable = [
        'transaction_type_id',
        'reference_id',
        'reference_type',
        'product_id',
        'sub_product_id',
        'inventory_type_id',
        'color_master_id',
        'size_id',
        'qty_before',
        'qty_after',
        'qty_change',
        'unit_price',
        'performed_by',
        'note',
    ];

    public function transactionType()
    {
        return $this->belongsTo(InventoryTransactionType::class, 'transaction_type_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }

    public function inventoryType()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_type_id');
    }

    public function colorMaster()
    {
        return $this->belongsTo(ColorMaster::class, 'color_master_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function performedBy()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}


