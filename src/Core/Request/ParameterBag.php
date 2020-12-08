<?php

declare(strict_types=1);

namespace App\Core\Request;

use ArrayIterator;
use IteratorAggregate;
use Traversable;

class ParameterBag implements IteratorAggregate
{
    protected $parameters;

    public function get(string $key, $default = null)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->parameters);
    }
}
