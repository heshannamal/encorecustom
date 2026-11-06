<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProductColor extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'sub_product_colors';
}
