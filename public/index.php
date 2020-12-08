<?php

declare(strict_types=1);

if (PHP_SAPI === 'cli-server' && preg_match('/\.(?:png|js|jpg|jpeg|gif|css|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/bootstrap.php';
