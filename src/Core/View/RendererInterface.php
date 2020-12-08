<?php

declare(strict_types=1);

namespace App\Core\View;

interface RendererInterface
{
    public function render(string $template, array $data = []): string;
}
