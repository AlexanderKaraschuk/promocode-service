<?php

declare(strict_types=1);

namespace App\User\Entity;

interface UserRepositoryInterface
{
    public function hasByEmail(string $email): bool;

    public function save(User $user): void;
}
