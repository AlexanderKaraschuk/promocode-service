<?php

declare(strict_types=1);

namespace App\Core\Database;

interface EntityInterface
{
    public static function fromState(array $state): self;
}
