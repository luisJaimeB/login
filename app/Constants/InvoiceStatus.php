<?php

namespace App\Constants;

class InvoiceStatus
{
    public const PAID = 'paid';
    public const PENDING = 'pending';
    public const CANCELED = 'canceled';

    public const STATUS = [
        PaymentStatus::APPROVED => self::PAID,
        PaymentStatus::REJECTED => self::CANCELED,
    ];

    public static function toArray(): array
    {
        return [
            self::PAID,
            self::PENDING,
            self::CANCELED,
        ];
    }
}
