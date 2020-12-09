<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence;

use App\User\Entity\User;
use App\User\Entity\UserRepositoryInterface;
use PDO;

class MysqlPdoUserRepository implements UserRepositoryInterface
{
    private const TABLE = 'users';

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function hasByEmail(string $email): bool
    {
        $statement = $this->pdo->prepare(sprintf("SELECT * FROM %s WHERE email = :email LIMIT 1;", self::TABLE));
        $statement->bindParam('email', $email);
        $statement->execute();

        return $statement->rowCount() !== 0;
    }

    public function save(User $user): void
    {
        // TODO: Implement save() method.
    }
}
