<?php

declare(strict_types=1);

namespace App\UI\Http\Action\User;

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Security\Security;
use App\UI\Http\Action\ActionInterface;

final class LogoutAction implements ActionInterface
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
        $this->security->logout();

        return $this->responseFactory->redirect('/signin');
    }
}
