<?php

namespace App\Constants;


class Categories 
{
    public const SIMULACION = 'simulacion';
    public const MUNDO_ABIERTO = 'mundo abierto';
    public const RPG = 'rpg';
    public const CARRERAS = 'carreras';
    public const ARCADE = 'arcade';
    public const GUERRA = 'guerra';
    public const MOBA = 'moba';


    public static function toArray(): array
    {
        return [
            self::SIMULACION,
            self::MUNDO_ABIERTO,
            self::RPG,
            self::CARRERAS,
            self::ARCADE,
            self::GUERRA,
            self::MOBA,
        ];

    }

};