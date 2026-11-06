<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmbellishmentTypeDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'embellishment_types';
}
