<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddress extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
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
}
