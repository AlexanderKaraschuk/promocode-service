<?php

declare(strict_types=1);

namespace App\User;

use App\Core\Container\ContainerInterface;
use App\Core\Container\ServiceProviderInterface;
use App\Core\Security\AuthUserProviderInterface;
use App\User\Entity\UserRepositoryInterface;
use App\User\Infrastructure\Persistence\UserRepository;
use App\User\UseCase\SignUp\CommandHandler as SignUpCommandHandler;

final class ServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $container->set(SignUpCommandHandler::class);
        $container->set(UserRepositoryInterface::class, UserRepository::class);
        $container->set(AuthUserProviderInterface::class, UserRepository::class);
    }
}
