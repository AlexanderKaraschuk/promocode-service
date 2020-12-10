<?php

declare(strict_types=1);

namespace App\Promocode\Entity;

use App\Core\Database\EntityInterface;

class Promocode implements EntityInterface
{
    private $id;

    private $value;

    private $userId;

    public function __construct(int $id, string $value, ?int $userId = null)
    {
        $this->id = $id;
        $this->value = $value;
        $this->userId = $userId;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function fromState(array $state): EntityInterface
    {
        return new self(
            (int)$state['id'],
            $state['value'],
            is_null($state['user_id']) ? $state['user_id'] : (int)$state['user_id']
        );
    }
}
