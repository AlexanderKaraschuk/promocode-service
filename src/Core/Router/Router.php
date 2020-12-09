<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Router\Event\AfterHandleEvent;
use App\Core\Router\Event\BeforeHandleEvent;
use App\Core\Router\Event\EventDispatcher;
use App\Core\Router\Exception\RouteNotFoundException;

final class Router
{
    /** @var Route[] */
    private $routes;

    private $handlerResolver;

    private $eventDispatcher;

    public function __construct(array $routes, RouteHandlerResolverInterface $handlerResolver, EventDispatcher $eventDispatcher)
    {
        $this->routes = $routes;
        $this->handlerResolver = $handlerResolver;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function dispatch(Request $request): Response
    {
        $route = $this->match($request);

        $handler = $this->handlerResolver->resovle($route->handler());

        $this->eventDispatcher->dispatch(new BeforeHandleEvent($request));

        $response = $handler($request) ?? new Response();

        $this->eventDispatcher->dispatch(new AfterHandleEvent($response));

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
