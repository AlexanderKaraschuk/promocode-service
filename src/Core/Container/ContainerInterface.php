<?php

declare(strict_types=1);

namespace App\Core\Container;

interface ContainerInterface
{
    /** @var mixed */
    public function get(string $id);

    public function has(string $id): bool;
}
