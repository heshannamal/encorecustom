<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSportDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'product_sports';

    public function sport()
    {
        return $this->belongsTo(SportDbModel::class, 'sport_id');
    }
}
