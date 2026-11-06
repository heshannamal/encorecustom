<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackingSlipItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'packing_slip_id',
        'order_id',
        'order_item_id',
        'product_id',
        'sub_product_id',
        'product_image_url',
        'product_name',
        'color_id',
        'size_id',
        'quantity',
        'base64_image'
    ];

    /**
     * Get the packing slip that owns the item.
     */
    public function packingSlip()
    {
        return $this->belongsTo(PackingSlip::class, 'packing_slip_id');
    }

    /**
     * Get the order item that this packing slip item refers to.
     */
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
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
        return $this->belongsTo(ColorMaster::class, 'color_id');
    }
}
