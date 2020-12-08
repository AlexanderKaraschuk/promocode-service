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
        $this->sendContent();
    }

    private function sendContent()
    {
        echo $this->body;
    }
}
