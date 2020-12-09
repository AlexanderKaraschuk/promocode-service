<?php

declare(strict_types=1);

namespace App\Core\Session;

interface SessionInterface
{
    public function start(): void;

    public function put(string $key, $value): void;

    /**
     * @return mixed
     */
    public function get(string $key, $default = null);

    public function has(string $key): bool;

    public function remove(string $key): void;
}
