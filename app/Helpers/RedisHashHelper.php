<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;

class RedisHashHelper
{
    public static function setHash(string $key, $value): void
    {
        Redis::hMset($key, $value);
    }

    public static function getHash(string $key): void
    {
        Redis::hGetAll($key);
    }
}
