<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class StringHelper
{
    public static function generateSlug(string $string): string
    {
        $str = preg_replace("/[^A-Za-z0-9 ]/", '', strtolower($string));

        return str_replace(' ','-',$str);
    }
}
