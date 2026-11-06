<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosDraftItem extends Model
{
    protected $fillable = [
        'draft_id',
        'sub_product_id',
        'quantity',
        'size_id',
        'color_id',
        'unit_price',
        'total_price'
    ];

    public function productDetails()
    {
        return $this->belongsTo(SubProductDbModel::class, 'sub_product_id');
    }
}
