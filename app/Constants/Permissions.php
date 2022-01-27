<?php

namespace App\Constants;


class Permissions 
{
    public const ROLES_INDEX = 'roles.index';
    public const ROLES_CREATE = 'roles.create';
    public const ROLES_SHOW = 'roles.show';
    public const ROLES_EDIT = 'roles.edit';
    public const ROLES_DESTROY = 'roles.destroy';

    public const USERS_INDEX = 'users.index';
    public const USERS_CREATE = 'users.create';
    public const USERS_SHOW = 'users.show';
    public const USERS_EDIT = 'users.edit';
    public const USERS_DESTROY = 'users.destroy';

    public const PRODUCTS_INDEX = 'products.index';
    public const PRODUCTS_CREATE = 'products.create';

    
    public static function toArray(): array
    {
        return [
            self::ROLES_INDEX,
            self::ROLES_CREATE,
            self::ROLES_SHOW,
            self::ROLES_EDIT,
            self::ROLES_DESTROY,
            self::USERS_INDEX,
            self::USERS_CREATE,
            self::USERS_SHOW,
            self::USERS_EDIT,
            self::USERS_DESTROY,
            self::PRODUCTS_INDEX,
            self::PRODUCTS_CREATE
        ];

    }

    public static function permissionToUser(): array
    {
        return [
            self::PRODUCTS_INDEX,
            self::PRODUCTS_CREATE
        ];
    }

};