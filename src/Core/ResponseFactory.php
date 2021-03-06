<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\View\RendererInterface;

final class ResponseFactory implements ResponseFactoryInterface
{
    private $viewRenderer;

    public function __construct(RendererInterface $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
    }

    public function view(string $template, array $data = [], $status = 200, array $headers = []): Response
    {
        return new Response($this->viewRenderer->render($template, $data), $status, $headers);
    }

    public function empty($status = 204): Response
    {
        return new Response('', $status);
    }

    public function redirect(string $to, $permanent = false): Response
    {
        return new Response('', $permanent ? 301 : 302, ['Location' => $to]);
    }
}
