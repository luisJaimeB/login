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
    public const PRODUCTS_SHOW = 'products.show';

    public const ADMIN_CATEGORIES_INDEX = 'admin.categories.index';

    public const ADMIN_PRODUCTS_INDEX = 'admin.products.index';
    public const ADMIN_PRODUCTS_CREATE = 'admin.products.create';
    public const ADMIN_PRODUCTS_SHOW = 'admin.products.show';
    public const ADMIN_PRODUCTS_EDIT = 'admin.products.edit';
    public const ADMIN_PRODUCTS_DESTROY = 'admin.products.destroy';

    public const ADMIN_INVOICES_INDEX = 'admin.invoices.index';
    public const INVOICES_INDEX = 'invoices.index';
    
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
            self::ADMIN_CATEGORIES_INDEX,
            self::PRODUCTS_INDEX,
            self::PRODUCTS_SHOW,
            self::INVOICES_INDEX,
            self::ADMIN_PRODUCTS_INDEX,
            self::ADMIN_PRODUCTS_CREATE,
            self::ADMIN_PRODUCTS_SHOW,
            self::ADMIN_PRODUCTS_EDIT,
            self::ADMIN_PRODUCTS_DESTROY,
            self::ADMIN_INVOICES_INDEX,
            
        ];

    }

    /* public static function permissionToAdmin(): array
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
            self::ADMIN_CATEGORIES_INDEX,
            self::PRODUCTS_INDEX,
            self::PRODUCTS_SHOW,
            self::ADMIN_PRODUCTS_INDEX,
            self::ADMIN_PRODUCTS_CREATE,
            self::ADMIN_PRODUCTS_SHOW,
            self::ADMIN_PRODUCTS_EDIT,
            self::ADMIN_PRODUCTS_DESTROY,
            self::ADMIN_INVOICES_INDEX,
        ];
    } */

    public static function permissionToUser(): array
    {
        return [
            self::PRODUCTS_INDEX,
            self::PRODUCTS_SHOW,
            self::INVOICES_INDEX,
        ];
    }

};