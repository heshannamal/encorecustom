<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProductColorDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sub_product_colors';
}
