<?php

declare(strict_types=1);

namespace App;

use App\Core\Container\ContainerInterface;
use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Router\Exception\RouteNotFoundException;
use App\Core\Router\Router;
use App\Core\Session\SessionInterface;

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
        $this->boot();
        $responseFactory = $this->container->get(ResponseFactoryInterface::class);

        try {
            $response = $this->runRouter($request);
        } catch (RouteNotFoundException $exception) {
            $response = $responseFactory->view('404', [], 404);
        }

        $response->send();
    }

    private function bootContainer()
    {
        $serviceProviders = require_once __DIR__ . '/../config/providers.php';

        foreach ($serviceProviders as $provider) {
            (new $provider())->register($this->container);
        }
    }

    private function boot()
    {
        $session = $this->container->get(SessionInterface::class);
        $session->start();
    }

    private function runRouter(Request $request): Response
    {
        $router = $this->container->get(Router::class);

        return $router->dispatch($request);
    }
}
