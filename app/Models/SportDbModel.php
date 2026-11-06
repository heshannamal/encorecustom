<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sports';
}
