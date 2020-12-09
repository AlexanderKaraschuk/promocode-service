<?php

declare(strict_types=1);

namespace App\Core\Router\Event;

use App\Core\Response\Response;

class AfterHandleEvent implements EventInterface
{
    const NAME = 'event.after.handle';

    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function args(): array
    {
        return [$this->response];
    }

    public function getName(): string
    {
        return static::NAME;
    }
}
