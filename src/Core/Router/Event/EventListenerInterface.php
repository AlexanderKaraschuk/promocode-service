<?php

declare(strict_types=1);

namespace App\Core\Router\Event;

interface EventListenerInterface
{
    public function handle(EventInterface $event);
}
