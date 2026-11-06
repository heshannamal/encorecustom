<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorMaster extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'color_masters';
}
