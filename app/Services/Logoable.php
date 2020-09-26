<?php

namespace App\Services;

use LaravelZero\Framework\Components\Logo\FigletString;

trait Logoable
{
    public static function convertStringToAscii($string)
    {
        return new FigletString($string, config('logo'));
    }
}
