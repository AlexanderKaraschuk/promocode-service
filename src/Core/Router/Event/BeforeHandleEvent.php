<?php

declare(strict_types=1);

namespace App\Core\Router\Event;

use App\Core\Request\Request;

class BeforeHandleEvent implements EventInterface
{
    const NAME = 'event.before.handle';

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function args(): array
    {
        return [$this->request];
    }

    public function getName(): string
    {
        return static::NAME;
    }
}
