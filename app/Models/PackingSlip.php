<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackingSlip extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'order_created_at',
        'customer_first_name',
        'customer_last_name',
        'customer_phone_number',
        'customer_email',
        'shipping_method_id',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_street',
        'shipping_city',
        'shipping_state',
        'shipping_postal_code',
        'shipping_country',
        'billing_first_name',
        'billing_last_name',
        'billing_street',
        'billing_city',
        'billing_state',
        'billing_postal_code',
        'billing_country',
        'store_id',
        'store_name',
        'store_code',
        'order_item_count',
        'dealer_email',
        'dealer_phone_number',
        'dealer_website',
        'slip_text',
    ];

    /**
     * Get the order that owns the packing slip.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the items for the packing slip.
     */
    public function items()
    {
        return $this->hasMany(PackingSlipItem::class, 'packing_slip_id', 'id');
    }

    public function shippingMethodDetail()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }
}
