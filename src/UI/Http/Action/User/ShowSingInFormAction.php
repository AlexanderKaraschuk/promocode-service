<?php

declare(strict_types=1);

namespace App\UI\Http\Action\User;

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Security\Security;
use App\UI\Http\Action\ActionInterface;

final class ShowSingInFormAction implements ActionInterface
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
        if ($this->security->currentUser() !== null) {
            return $this->responseFactory->redirect('/');
        }

        return $this->responseFactory->view('user/signin');
    }
}
