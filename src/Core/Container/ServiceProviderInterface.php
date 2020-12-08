<?php

declare(strict_types=1);

namespace App\Core\Container;

interface ServiceProviderInterface
{
    public function register(ContainerInterface $container): void;
}
