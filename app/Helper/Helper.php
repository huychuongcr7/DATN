<?php

namespace App\Helper;

class Helper
{
    public static function formatMoney($money)
    {
        return number_format($money,0,',','.');
    }
}
