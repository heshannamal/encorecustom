<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'temp_id',
        'sub_product_id',
        'quantity',
        'size_id',
        'color_id',
        'is_purchased'
    ];

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }

}
