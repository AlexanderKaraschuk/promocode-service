<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Container\ContainerInterface;
use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Router\Exception\RouteNotFoundException;
use Closure;

final class Router
{
    /** @var Route[] */
    private $routes;

    private $container;

    public function __construct(array $routes, ContainerInterface $container)
    {
        $this->routes = $routes;
        $this->container = $container;
    }

    public function dispatch(Request $request): Response
    {
        $route = $this->match($request);

        $handler = $route->handler();

        if (!$handler instanceof Closure) {
            $handler = $this->container->get($handler);
        }

        return $handler($request) ?? new Response();
    }

    public function match(Request $request): Route
    {
        foreach ($this->routes as $route) {
            if ($route->method() === $request->method() && preg_match($route->uri(), $request->uri())) {
                return $route;
            }
        }

        throw new RouteNotFoundException();
    }
}
