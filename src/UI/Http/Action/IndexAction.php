<?php

declare(strict_types=1);

namespace App\UI\Http\Action;

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Security\Security;

final class IndexAction implements ActionInterface
{
    private $responseFactory;

    private $security;

    public function __construct(ResponseFactoryInterface $responseFactory, Security $security)
    {
        $this->responseFactory = $responseFactory;
        $this->security = $security;
    }

    public function __invoke(Request $request): ?Response
    {
        if (!$this->security->currentUser()) {
            return $this->responseFactory->redirect('/signin');
        }

        return $this->responseFactory->view('index');
    }
}
