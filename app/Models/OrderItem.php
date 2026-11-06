<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'inventory_type_id',
        'sales_channel_id',
        'product_id',
        'sub_product_id',
        'size_id',
        'color_master_id',
        'quantity',
        'unit_price',
        'total_price',
        'is_active',
    ];

    public function orderDetail()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function productDetail()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function subProductDetail()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }

    public function sizeDetail()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function colorDetail()
    {
        return $this->belongsTo(ColorMaster::class, 'color_master_id');
    }

    public function subProduct()
{
    return $this->belongsTo(SubProductDbModel::class, 'sub_product_id', 'id')
        ->with(['productDetails']);
}

protected $appends = ['product_name'];

public function getProductNameAttribute()
{
    return $this->subProduct?->productDetails?->product_name;
}
}
