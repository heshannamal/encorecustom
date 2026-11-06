<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesChannelSubProduct extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $table = 'sales_channel_sub_products';
    public $timestamps = false;
    protected $fillable = [
        'sales_channel_id',
        'sub_product_id',
        'is_active',
    ];

    public function salesChannel()
    {
        return $this->belongsTo(SalesChannel::class, 'sales_channel_id');
    }

    public function masterStock()
    {
        return $this->hasMany(MasterStock::class, 'sub_product_id', 'sub_product_id');
    }

    public function stockQuantity()
    {
        return $this->masterStock()->sum('stock_qty');
    }
}

