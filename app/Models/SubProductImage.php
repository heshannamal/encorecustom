<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProductImage extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'sub_product_images';
}
