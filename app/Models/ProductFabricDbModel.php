<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFabricDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'product_fabrics';
}
