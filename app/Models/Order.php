<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\InventoryType;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'inventory_type_id',
        'sales_channel_id',
        'sub_total',
        'items_count',
        'payment_status',
        'payment_method_id',
        'fulfillment_status',
        'shipping_fee',
        'sales_tax',
        'invoice_total',
        'other_fee',
        'balance_invoice',
        'processing_fee',
        'paid_amount',
        'shipping_method_id',
        'shipping_address',
        'shipping_street',
        'shipping_city',
        'shipping_state',
        'shipping_country',
        'shipping_postal_code',
        'shipping_phone',

        'payment_method',
        'customer_cash',
        'balance',

        'discount_type',
        'discount_value',
        'discount_amount',

        'card_type',
        'card_last_four',

        'shipping_address',
        'shipping_country',
        'shipping_postal_code',
        'shipping_phone',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function userDetails()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customerDetails()
    {
        return $this->hasOne(CustomerDetail::class, 'user_id', 'user_id');
    }

    public function shippingMethodDetail()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id');
    }

    public function paymentMethodDetail()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function inventoryType()
    {
        return $this->belongsTo(InventoryType::class, 'inventory_type_id');
    }

    public function salesChannel()
    {
        return $this->belongsTo(SalesChannel::class, 'sales_channel_id');
    }

    /**
     * Get the shipping label associated with the order.
     */
    public function shippingLabel()
    {
        return $this->hasOne(ShippingLabel::class, 'order_id');
    }

    /**
     * Get the packing slip associated with the order.
     */
    public function packingSlip()
    {
        return $this->hasOne(PackingSlip::class, 'order_id');
    }

    public function orderBillingDetail()
    {
        return $this->hasOne(OrderBillingDetail::class, 'order_id');
    }

    public function orderPaymentDetail()
    {
        return $this->hasOne(OrderPaymentDetail::class, 'order_id');
    }

    public function subProduct()
    {
        return $this->belongsTo(SubProductDbModel::class,'sub_product_id');
    }
}
