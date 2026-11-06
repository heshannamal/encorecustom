<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransfer extends Model
{
    protected $fillable = [
        'from_inventory_type_id',
        'to_inventory_type_id',
        'created_by',
    ];

    public function items()
    {
        return $this->hasMany(InventoryTransferItem::class, 'inventory_transfer_id');
    }
}


