<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorMasterDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'color_masters';
}
