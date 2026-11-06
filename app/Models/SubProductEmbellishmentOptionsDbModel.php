<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProductEmbellishmentOptionsDbModel extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'sub_product_embellishment_options';
    public $timestamps = false;

    public function embellishmentDetails() // 👈 lowercase!
    {
        return $this->belongsTo(
            EmbellishmentTypeDbModel::class,
            'embellishment_option', // FK column in this table
            'id'                    // PK in embellishment_types table
        );
    }
}

