<?php

declare(strict_types=1);

namespace App;

use App\Core\Container\ContainerInterface;
use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Router\Router;

final class Kernel
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle(Request $request)
    {
        $this->bootContainer();
        $response = $this->runRouter($request);

        $response->send();
    }

    private function bootContainer()
    {
        $serviceProviders = require_once __DIR__ . '/../config/providers.php';

        foreach ($serviceProviders as $provider) {
            (new $provider())->register($this->container);
        }
    }

    private function runRouter(Request $request): Response
    {
        $router = $this->container->get(Router::class);

        return $router->dispatch($request);
    }
}
