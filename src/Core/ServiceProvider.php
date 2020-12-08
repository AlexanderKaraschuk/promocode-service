<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Container\ContainerInterface;
use App\Core\Container\ServiceProviderInterface;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Router\Router;
use App\Core\View\PhpRenderer;
use App\Core\View\RendererInterface;

final class ServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $container->set(Router::class, function (ContainerInterface $container) {
            $routes = require_once __DIR__ . '/../../config/routes.php';
            return new Router($routes, $container);
        });

        $container->set(ResponseFactoryInterface::class, ResponseFactory::class);
        $container->set(RendererInterface::class, function (ContainerInterface $container) {
            return new PhpRenderer(__DIR__ . '/../../templates/');
        });
    }
}
