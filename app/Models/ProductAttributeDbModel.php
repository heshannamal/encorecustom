<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'product_attributes';

    public function attribute()
    {
        return $this->belongsTo(AttributeDbModel::class, 'attribute_id', 'id');
    }
}

