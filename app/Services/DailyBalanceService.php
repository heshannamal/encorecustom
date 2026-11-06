<?php

namespace App\Services;

use App\Models\DailyBalance;
use Carbon\Carbon;

class DailyBalanceService
{
    public static function getToday($tz = 'America/Los_Angeles')
    {
        $today = Carbon::now($tz)->toDateString();

        return DailyBalance::whereDate('date', $today)->first();
    }

    public static function isSystemOpen()
    {
        $daily = self::getToday();

        return $daily && $daily->is_open == 1 && $daily->is_closed == 0;
    }
}
