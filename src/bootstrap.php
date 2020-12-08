<?php

declare(strict_types=1);

use App\Core\Container\SimpleContainer;
use App\Core\Request\Request;
use App\Kernel;

$container = new SimpleContainer();

$request = new Request($_GET, $_POST, $_SERVER);

$kernel = new Kernel($container);
$kernel->handle($request);
