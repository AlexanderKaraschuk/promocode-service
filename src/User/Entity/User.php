<?php

declare(strict_types=1);

namespace App\User\Entity;

use App\Core\Database\EntityInterface;

final class User implements EntityInterface
{
    private $id;

    private $email;

    private $password;

    private function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function fromState(array $state): EntityInterface
    {
        return (new self($state['email'], $state['password']))->setId($state['id']);
    }
}
