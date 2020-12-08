<?php

declare(strict_types=1);

namespace App\UI;

use App\Core\Container\ContainerInterface;
use App\Core\Container\ServiceProviderInterface;
use App\UI\Http\Action\IndexAction;

final class ServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $container->set(IndexAction::class);
    }
}
