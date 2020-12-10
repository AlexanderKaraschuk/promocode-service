<?php

declare(strict_types=1);

namespace App\Core\Session;

use InvalidArgumentException;

final class FlashBag
{
    private const SESSION_KEY = '_flash_messages';

    const ERROR = 'error';
    const SUCCESS = 'success';

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function add(string $type, string $message): void
    {
        if (!in_array($type, [self::ERROR, self::SUCCESS])) {
            throw new InvalidArgumentException('Invalid type');
        }

        $messages = $this->session->get(self::SESSION_KEY, []);
        $messages[$type][] = $message;

        $this->session->put(self::SESSION_KEY, $messages);
    }

    public function pop(): array
    {
        $messages = $this->session->get(self::SESSION_KEY, []);
        $this->session->remove(self::SESSION_KEY);

        return $messages;
    }
}
