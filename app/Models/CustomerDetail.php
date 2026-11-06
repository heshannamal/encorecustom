<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerDetail extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'preferred_language',
        'country_id',
        'country',
        'country_code',
        'dial_code',
        'phone_number',
        'address',
        'street',
        'city',
        'state',
        'postal_code',
        'is_active',
    ];

    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function countryDetail()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class, 'user_id', 'user_id');
    }
}
