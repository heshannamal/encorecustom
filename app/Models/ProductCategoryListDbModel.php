<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryListDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'product_category_lists';
    public $timestamps = false;

    // ✅ ADD THIS
    public function categories()
    {
        return $this->belongsTo(
            ProductCategoryDbModel::class,
            'product_category_id', // FK in this table
            'id'                   // PK in product_categories table
        );
    }
    
}
