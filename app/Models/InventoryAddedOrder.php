<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryAddedOrder extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'inventory_added_orders';

    protected $fillable = [
        'order_id',
        'inventory_type_id',
        'status',
        'sent_by',
        'responded_by',
        'inventory_id',
    ];

    public function ecOrder()
    {
        return $this->belongsTo(EcOrder::class, 'order_id', 'id');
    }

    public function inventoryType()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_type_id');
    }

    public function sentBy()
    {
        return $this->belongsTo(EcUser::class, 'sent_by');
    }

    public function respondedBy()
    {
        return $this->belongsTo(User::class, 'responded_by');
    }
}
