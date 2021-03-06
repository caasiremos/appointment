<?php

namespace App\Utils;

use Illuminate\Support\Str;

class Util
{
    public static function formatTelephone($number): string
    {
        if (Str::startsWith($number, '07')) {
            $number = Str::replace('07', '2567', $number);
        }
        if (Str::startsWith($number, '+2567')){
            $number = Str::replace('+2567', '2567', $number);
        }
        return $number;
    }
}
