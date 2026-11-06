<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategoryDbModel extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'main_categories';

}
