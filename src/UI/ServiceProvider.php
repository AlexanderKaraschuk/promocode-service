<?php

declare(strict_types=1);

namespace App\UI;

use App\Core\Container\ContainerInterface;
use App\Core\Container\ServiceProviderInterface;
use App\UI\Http\Action\IndexAction;
use App\UI\Http\Action\User\ShowSingUpFormAction;
use App\UI\Http\Action\User\SignUpAction;

final class ServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $container->set(IndexAction::class);
        $container->set(ShowSingUpFormAction::class);
        $container->set(SignUpAction::class);
    }
}
