<?php

namespace App\Constants;

class ImportType
{
    public const PRODUCTS = 'products';


    public static function toArray(): array
    {
        return [
            self::PRODUCTS,
        ];
    }
}
