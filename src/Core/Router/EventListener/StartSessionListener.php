<?php

declare(strict_types=1);

namespace App\Core\Router\EventListener;

use App\Core\Router\Event\EventInterface;
use App\Core\Router\Event\EventListenerInterface;
use App\Core\Session\SessionInterface;

final class StartSessionListener implements EventListenerInterface
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function handle(EventInterface $event)
    {
        $this->session->start();
    }
}
