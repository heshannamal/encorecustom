<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMainCategory extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'product_main_categories';
}
