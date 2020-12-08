<?php

declare(strict_types=1);

namespace App\UI\Http\Action;

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;

final class IndexAction implements ActionInterface
{
    private $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function __invoke(Request $request): ?Response
    {
        return $this->responseFactory->view('index');
    }
}