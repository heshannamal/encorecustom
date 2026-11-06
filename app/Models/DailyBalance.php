<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyBalance extends Model
{
    protected $fillable = [

        'date',
        'opening_balance',
        'cash_sales',
        'expected_balance',
        'closing_balance',
        'is_open',
        'is_closed',
        'opened_at',
        'closed_at',
    ];
}
