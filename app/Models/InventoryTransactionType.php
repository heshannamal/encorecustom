<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransactionType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    public function logs()
    {
        return $this->hasMany(InventoryTransactionLog::class, 'transaction_type_id');
    }
}


