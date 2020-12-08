<?php

declare(strict_types=1);

namespace App\Core\Response;

interface ResponseFactoryInterface
{
    public function view(string $template, array $data = [], $status = 200, array $headers = []): Response;

    public function empty(): Response;

    public function redirect($permanent = false): Response;
}
