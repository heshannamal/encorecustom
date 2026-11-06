<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcOrderItem extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'sub_product_id',
        'size_id',
        'color_master_id',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function ecOrder()
    {
        return $this->belongsTo(EcOrder::class, 'order_id', 'id');
    }

    public function ecOrderItemDetails()
    {
        return $this->hasMany(EcOrderItemDetail::class, 'order_item_id', 'id')->where(function($qr){$qr->where('qty', '>', 0)->orWhere('blanks', '>', 0);});
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_no', 'sub_product_no');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(ColorMaster::class, 'color_master_id');
    }
}
