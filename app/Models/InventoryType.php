<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryType extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];
}
