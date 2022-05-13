<?php

namespace App\Constants;

class Languajes
{
    public const EN = 'en';
    public const ES = 'es';

    public static function toArray(): array
    {
        return [
            self::EN,
            self::ES,
        ];
    }
};
