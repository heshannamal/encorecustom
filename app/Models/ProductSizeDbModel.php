<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSizeDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'product_sizes';
}
