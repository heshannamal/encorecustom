<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterFitDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'master_fits';
}
