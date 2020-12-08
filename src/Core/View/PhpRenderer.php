<?php

declare(strict_types=1);

namespace App\Core\View;

class PhpRenderer implements RendererInterface
{
    private $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function render(string $template, array $data = []): string
    {
        $templatePath = $this->basePath . $template . '.php';

        ob_start();
        extract($data);
        require $this->basePath . '/base.php';

        return ob_get_clean();
    }
}
