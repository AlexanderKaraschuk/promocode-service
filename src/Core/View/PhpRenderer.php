<?php

declare(strict_types=1);

namespace App\Core\View;

use App\Core\Session\FlashBag;

class PhpRenderer implements RendererInterface
{
    private $basePath;

    private $flashBag;

    public function __construct(string $basePath, FlashBag $flashBag)
    {
        $this->basePath = $basePath;
        $this->flashBag = $flashBag;
    }

    public function render(string $template, array $data = []): string
    {
        $templatePath = $this->basePath . $template . '.php';
        $flashMessages = $this->getFlashMessages();

        ob_start();
        extract($data);
        require $this->basePath . '/base.php';

        return ob_get_clean();
    }

    public function getFlashMessages(): string
    {
        $messages = $this->flashBag->pop();

        ob_start();
        require $this->basePath . '/flash_messages.php';

        return ob_get_clean();
    }
}
