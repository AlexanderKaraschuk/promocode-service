<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Container\ContainerInterface;
use Closure;

class ContainerRouteHandlerResolver implements RouteHandlerResolverInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function resovle($handler): callable
    {
        if ($handler instanceof Closure) {
            return $handler;
        }

        return $handler = $this->container->get($handler);
    }
}
