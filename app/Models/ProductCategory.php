<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'product_categories';
}
