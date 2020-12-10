<?php

declare(strict_types=1);

namespace App\Core\Session;

use RuntimeException;

class NativeSession implements SessionInterface
{
    public function put(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null)
    {
        return $this->has($key) ? $_SESSION[$key] : $default;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION ?? []);
    }

    public function start(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        if (!session_start()) {
            throw new RuntimeException('Cannot start session');
        }
    }

    public function remove(string $key): void
    {
        if ($this->has($key) && $_SESSION !== null) {
            unset($_SESSION[$key]);
        }
    }
}
