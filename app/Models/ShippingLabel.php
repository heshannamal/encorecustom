<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingLabel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'order_no',
        'shipment_id',
        'shipping_name',
        'carrier',
        'selected_rate',
        'rate',
        'service',
        'estimated_days',
        'tracking_object_id',
        'tracking_number',
        'tracking_url',
        'label_url',
        'is_shipped',
        'is_shipping_removed',
    ];

    /**
     * Get the order that owns the shipping label.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
