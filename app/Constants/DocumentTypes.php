<?php

namespace App\Constants;


class DocumentTypes 
{
    public const CC = 'CC';
    public const CE = 'CE';

    public static function toArray(): array
    {
        return [
            self::CC,
            self::CE,
        ];

    }

};