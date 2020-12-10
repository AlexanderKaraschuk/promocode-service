<?php

declare(strict_types=1);

namespace App\Promocode\Entity;

interface PromocodeRepositoryInterface
{
    public function findByUserId(int $userId): ?Promocode;

    public function takeForUserId(int $userId): void;
}
