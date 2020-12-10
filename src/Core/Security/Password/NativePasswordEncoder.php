<?php

declare(strict_types=1);

namespace App\Core\Security\Password;

use RuntimeException;

final class NativePasswordEncoder implements PasswordEncoder
{
    const ALGO = PASSWORD_ARGON2I;

    public function hash(string $plainPassword): string
    {
        $hash = password_hash($plainPassword, PASSWORD_ARGON2I);

        if ($hash === null) {
            throw new RuntimeException('Invalid hash algorithm.');
        }
        if ($hash === false) {
            throw new RuntimeException('Unable to generate hash.');
        }

        return $hash;
    }

    public function match(string $plainPassword, string $hash): bool
    {
        return password_verify($plainPassword, $hash);
    }
}
