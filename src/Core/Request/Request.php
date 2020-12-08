<?php

declare(strict_types=1);

namespace App\Core\Request;

class Request
{
    private $query;

    private $request;

    private $server;

    public function __construct(array $query = [], array $request = [], array $server = [])
    {
        $this->query = new ParameterBag($query);
        $this->request = new ParameterBag($request);
        $this->server = new ParameterBag($server);
    }

    public function method(): string
    {
        return strtoupper($this->server->get('REQUEST_METHOD'));
    }

    public function uri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
}
