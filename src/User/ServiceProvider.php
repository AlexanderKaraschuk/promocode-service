<?php

declare(strict_types=1);

namespace App\User;

use App\Core\Container\ContainerInterface;
use App\Core\Container\ServiceProviderInterface;
use App\User\Entity\UserRepositoryInterface;
use App\User\Infrastructure\Persistence\MysqlPdoUserRepository;
use App\User\UseCase\SignUp\CommandHandler as SignUpCommandHandler;

final class ServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $container->set(SignUpCommandHandler::class);
        $container->set(UserRepositoryInterface::class, MysqlPdoUserRepository::class);
    }
}
