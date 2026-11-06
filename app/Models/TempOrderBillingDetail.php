<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempOrderBillingDetail extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'street',
        'city',
        'state',
        'postal_code',
        'country',
        'is_shipping_address_available',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_email',
        'shipping_phone',
        'shipping_address',
        'shipping_street',
        'shipping_city',
        'shipping_state',
        'shipping_postal_code',
        'shipping_country',
    ];
}
