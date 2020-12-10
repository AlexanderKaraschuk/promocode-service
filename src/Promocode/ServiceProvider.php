<?php

declare(strict_types=1);

namespace App\Promocode;

use App\Core\Container\ContainerInterface;
use App\Core\Container\ServiceProviderInterface;
use App\Promocode\Entity\PromocodeRepositoryInterface;
use App\Promocode\Infrastructure\Persistence\PromocodeRepository;
use App\Promocode\UseCase\GetForUser\CommandHandler;

final class ServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $container->set(PromocodeRepositoryInterface::class, PromocodeRepository::class);
        $container->set(CommandHandler::class);
    }
}
