<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFabricMasterDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'fabrics';
}
