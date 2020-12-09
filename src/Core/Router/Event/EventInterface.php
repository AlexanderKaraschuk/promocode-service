<?php

declare(strict_types=1);

namespace App\Core\Router\Event;

interface EventInterface
{
    public function args(): array;

    public function getName(): string;
}
