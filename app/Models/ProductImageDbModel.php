<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImageDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'product_images';
}
