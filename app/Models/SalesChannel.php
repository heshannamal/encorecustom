<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesChannel extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function subProducts()
    {
        return $this->hasMany(SalesChannelSubProduct::class, 'sales_channel_id');
    }
}

