<?php

declare(strict_types=1);

namespace App\Core\Asset;

class Assert
{
    public static function email($value, $message = ''): void
    {
        if (false === \filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException($message ?: 'Email must be valid');
        }
    }

    public static function minStringLength($value, int $min, $message = ''): void
    {
        if ($min > mb_strlen($value)) {
            throw new InvalidArgumentException($message ?: "String must be at least {$min} char");
        }
    }
}
