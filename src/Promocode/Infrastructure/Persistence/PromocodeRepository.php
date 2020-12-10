<?php

declare(strict_types=1);

namespace App\Promocode\Infrastructure\Persistence;

use App\Core\Database\DatabaseAdapterInterface;
use App\Promocode\Entity\Promocode;
use App\Promocode\Entity\PromocodeRepositoryInterface;

class PromocodeRepository implements PromocodeRepositoryInterface
{
    private const TABLE = 'promocodes';

    private $databaseAdapter;

    public function __construct(DatabaseAdapterInterface $databaseAdapter)
    {
        $this->databaseAdapter = $databaseAdapter;
    }

    public function findByUserId(int $userId): ?Promocode
    {
        $result = $this->databaseAdapter->findOneBy(self::TABLE, ['user_id' => $userId]);

        if ($result === false) {
            return null;
        }

        return Promocode::fromState($result);
    }

    public function takeForUserId(int $userId): void
    {
        $statement = sprintf(
            "UPDATE %s SET user_id = :user_id, issued_at = NOW()  WHERE user_id is null limit 1",
            self::TABLE
        );

        $this->databaseAdapter->execute($statement, ['user_id' => $userId]);
    }
}
