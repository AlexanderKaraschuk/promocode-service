<?php

declare(strict_types=1);

namespace App\Core\Router\Event;

final class EventDispatcher
{
    private $listeners = [];

    public function addListener(string $name, EventListenerInterface $handler): void
    {
        $this->listeners[$name][] = $handler;
    }

    public function dispatch(EventInterface $event): void
    {
        if (isset($this->listeners[$event->getName()])) {
            foreach ($this->listeners[$event->getName()] as $listener) {
                $listener->handle($event);
            }
        }
    }
}
