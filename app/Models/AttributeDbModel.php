<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'attributes';
}
