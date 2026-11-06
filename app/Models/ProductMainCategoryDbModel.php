<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMainCategoryDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'product_main_categories';

    public function mainCategory()
    {
        return $this->belongsTo(MainCategoryDbModel::class, 'main_category_id');
    }
}
