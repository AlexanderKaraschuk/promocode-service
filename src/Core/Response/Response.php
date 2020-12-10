<?php

declare(strict_types=1);

namespace App\Core\Response;

class Response
{
    private $body;

    private $status;

    private $headers;

    public function __construct(string $body = '', int $status = 200, array $headers = [])
    {
        $this->body = $body;
        $this->headers = $headers;
        $this->status = $status;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    private function sendContent(): void
    {
        echo $this->body;
    }

    private function sendHeaders(): void
    {
        if (headers_sent()) {
            return;
        }

        foreach ($this->headers as $name => $value) {
            header($name . ': ' . $value, true, $this->status);
        }

        http_response_code($this->status);
    }
}
