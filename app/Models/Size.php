<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'sizes';
}
