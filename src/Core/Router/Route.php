<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Router\Exception\RouteHandlerInvalidTypeException;
use Closure;

class Route implements RouteInterface
{
    private $uri;

    private $handler;

    private $method;

    public function __construct(string $uri, $handler, string $method)
    {
        if (!is_string($handler) && !$handler instanceof Closure) {
            throw new RouteHandlerInvalidTypeException();
        }

        $this->uri = $uri;
        $this->handler = $handler;
        $this->method = $method;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function handler()
    {
        return $this->handler;
    }

    public function method(): string
    {
        return $this->method;
    }

    public static function get(string $uri, $handler): self
    {
        return new self($uri, $handler, RouteInterface::GET);
    }

    public static function post(string $uri, $handler): self
    {
        return new self($uri, $handler, RouteInterface::POST);
    }
}
