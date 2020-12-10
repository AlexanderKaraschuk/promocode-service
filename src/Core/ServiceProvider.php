<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Container\ContainerInterface;
use App\Core\Container\ServiceProviderInterface;
use App\Core\Database\DatabaseAdapterInterface;
use App\Core\Database\MysqlDatabaseAdapter;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Router\ContainerRouteHandlerResolver;
use App\Core\Router\RouteHandlerResolverInterface;
use App\Core\Router\Router;
use App\Core\Security\Password\NativePasswordEncoder;
use App\Core\Security\Password\PasswordEncoder;
use App\Core\Security\Security;
use App\Core\Session\FlashBag;
use App\Core\Session\NativeSession;
use App\Core\Session\SessionInterface;
use App\Core\View\PhpRenderer;
use App\Core\View\RendererInterface;
use PDO;

final class ServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $container->set(PDO::class, function () {
            $dsn = sprintf(
                'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
                getenv('DB_HOST'),
                getenv('DB_PORT'),
                getenv('DB_DATABASE')
            );

            return new PDO(
                $dsn,
                getenv('DB_USERNAME'),
                getenv('DB_PASSWORD'),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        });

        $container->set(SessionInterface::class, NativeSession::class);

        $container->set(FlashBag::class);

        $container->set(RouteHandlerResolverInterface::class, function (ContainerInterface $container) {
            return new ContainerRouteHandlerResolver($container);
        });

        $container->set(Router::class, function (ContainerInterface $container) {
            $routes = require_once __DIR__ . '/../../config/routes.php';
            return new Router(
                $routes,
                $container->get(RouteHandlerResolverInterface::class)
            );
        });

        $container->set(ResponseFactoryInterface::class, ResponseFactory::class);
        $container->set(RendererInterface::class, function (ContainerInterface $container) {
            return new PhpRenderer(
                __DIR__ . '/../../templates/',
                $container->get(FlashBag::class),
                $container->get(Security::class)
            );
        });

        $container->set(PasswordEncoder::class, NativePasswordEncoder::class);
        $container->set(DatabaseAdapterInterface::class, MysqlDatabaseAdapter::class);
        $container->set(Security::class);
    }
}
