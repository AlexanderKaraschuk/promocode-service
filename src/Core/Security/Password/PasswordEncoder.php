<?php

declare(strict_types=1);

namespace App\Core\Security\Password;

interface PasswordEncoder
{
    public function hash(string $plainPassword): string;

    public function match(string $plainPassword, string $hash): bool;
}
