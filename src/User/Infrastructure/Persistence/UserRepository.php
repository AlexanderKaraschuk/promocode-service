<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Persistence;

use App\Core\Database\DatabaseAdapterInterface;
use App\Core\Security\AuthUserInterface;
use App\Core\Security\AuthUserProviderInterface;
use App\User\Entity\User;
use App\User\Entity\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface, AuthUserProviderInterface
{
    private const TABLE = 'users';

    private $databaseAdapter;

    public function __construct(DatabaseAdapterInterface $databaseAdapter)
    {
        $this->databaseAdapter = $databaseAdapter;
    }

    public function hasByEmail(string $email): bool
    {
        return $this->databaseAdapter->exists(self::TABLE, ['email' => $email]);
    }

    public function save(User $user): void
    {
        $values = ['email' => $user->getEmail(), 'password' => $user->getPassword()];

        if (!$user->getId()) {
            $id = $this->databaseAdapter->insert(self::TABLE, $values);
            $user->setId((int)$id);
        } else {
            $this->databaseAdapter->update(self::TABLE, $values, ['id' => $user->getId()]);
        }
    }

    public function loadByEmail(string $email): ?AuthUserInterface
    {
        $result = $this->databaseAdapter->findOneBy(self::TABLE, ['email' => $email]);

        if ($result === false) {
            return null;
        }

        return User::fromState($result);
    }
}
