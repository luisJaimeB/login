<?php

namespace App\Constants;

class ImportStatus
{
    public const COMPLETE = 'complete';
    public const PROCESSING = 'processing';
    public const PENDING = 'pending';
    public const FAILED = 'failed';
    public const COMPLETERRORS = 'completed with errors';

    public static function toArray(): array
    {
        return [
            self::COMPLETE,
            self::PROCESSING,
            self::PENDING,
            self::FAILED,
            self::COMPLETERRORS,
        ];
    }
}
