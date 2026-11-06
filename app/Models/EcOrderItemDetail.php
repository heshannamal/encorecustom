<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcOrderItemDetail extends Model
{
    protected $connection = 'mysql2'; // second DB connection
    protected $table = 'order_items_details';

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
