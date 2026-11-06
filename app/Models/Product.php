<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'products';

    public function productCategories(){
        return $this->hasMany(ProductCategoryList::class, 'product_id', 'id');
    }

   public function productMainCategories()
    {
        return $this->hasMany(ProductMainCategory::class, 'product_id');
    }

    public function subProducts()
    {
        return $this->hasMany(SubProduct::class, 'parent_product_id', 'id');
    }
}
