<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProduct extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'sub_products';

    public function product()
    {
        return $this->belongsTo(Product::class, 'parent_product_id', 'id');
    }

    public function retailPrice()
    {
        return $this->belongsTo(SubProductPrice::class, 'sub_product_no', 'sub_product_no')->where('price_type', 1)->where('active', 1);
    }

    public function salesChannelSubProducts()
    {
        return $this->hasMany(SalesChannelSubProduct::class, 'sub_product_id', 'id');
    }

    public function activeSalesChannelSubProducts()
    {
        return $this->hasMany(SalesChannelSubProduct::class, 'sub_product_id', 'id')->where('is_active', 1);
    }

    public function colorDetail()
    {
        return $this->belongsTo(ColorMaster::class, 'color_master_id', 'id');
    }    
}
