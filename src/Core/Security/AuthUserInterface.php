<?php

declare(strict_types=1);

namespace App\Core\Security;

interface AuthUserInterface
{
    public function getId();

    public function getEmail(): string;

    public function getPassword(): string;
}
