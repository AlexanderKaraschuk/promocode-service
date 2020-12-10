<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Router\Exception\RouteNotFoundException;

final class Router
{
    /** @var Route[] */
    private $routes;

    private $handlerResolver;

    public function __construct(array $routes, RouteHandlerResolverInterface $handlerResolver)
    {
        $this->routes = $routes;
        $this->handlerResolver = $handlerResolver;
    }

    public function dispatch(Request $request): Response
    {
        $route = $this->match($request);
        $handler = $this->handlerResolver->resovle($route->handler());

        $response = $handler($request) ?? new Response();

        return $response;
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
