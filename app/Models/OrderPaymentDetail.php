<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentDetail extends Model
{
    protected $fillable = [
        'order_id',
        'order_billing_detail_id',
        'card_type_id',
        'card_holder_name',
        'card_number',
        'card_last_four_digit',
        'card_expiry_month',
        'card_expiry_year',
        'card_csv',
        'sub_total',
        'shipping_fee',
        'invoice_total',
        'processing_fee',
        'paid_amount',
        'transaction_id',
        'transaction_account_number',
        'transaction_account_type',
        'transaction_response_code',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderBillingDetail()
    {
        return $this->belongsTo(OrderBillingDetail::class);
    }
}
