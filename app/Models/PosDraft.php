<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosDraft extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount'
    ];

    public function items()
    {
        return $this->hasMany(PosDraftItem::class, 'draft_id');
    }
}
