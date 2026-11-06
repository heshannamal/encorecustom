<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTaglineListDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'product_tagline_lists';
}
