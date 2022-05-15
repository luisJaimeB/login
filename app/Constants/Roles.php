<?php

namespace App\Constants;

class Roles
{
    public const ROLE_ADMIN = 'Admin';
    public const ROLE_USER = 'User';


    public static function toArray(): array
    {
        return [self::ROLE_ADMIN,
            self::ROLE_USER
            ];
    }
};
