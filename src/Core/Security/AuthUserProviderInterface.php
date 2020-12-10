<?php

declare(strict_types=1);

namespace App\Core\Security;

interface AuthUserProviderInterface
{
    public function loadByEmail(string $email): ?AuthUserInterface;
}
