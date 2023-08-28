<?php

namespace App\Helper;

class ServerHelper
{
    public static function isOnWindows()
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }
}
