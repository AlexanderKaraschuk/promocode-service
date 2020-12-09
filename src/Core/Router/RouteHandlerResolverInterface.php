<?php

declare(strict_types=1);

namespace App\Core\Router;

interface RouteHandlerResolverInterface
{
    public function resovle($handler): callable;
}
