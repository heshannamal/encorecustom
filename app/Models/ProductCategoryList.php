<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryList extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'product_category_lists';

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }
}
