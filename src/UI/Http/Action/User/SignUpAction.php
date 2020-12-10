<?php

declare(strict_types=1);

namespace App\UI\Http\Action\User;

use App\Core\Asset\InvalidArgumentException;
use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Security\Security;
use App\Core\Session\FlashBag;
use App\UI\Http\Action\ActionInterface;
use App\User\UseCase\SignUp\Command;
use App\User\UseCase\SignUp\CommandHandler;
use DomainException;

final class SignUpAction implements ActionInterface
{
    private $responseFactory;

    private $handler;

    private $flashBag;

    private $security;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        CommandHandler $handler,
        FlashBag $flashBag,
        Security $security
    )
    {
        $this->responseFactory = $responseFactory;
        $this->handler = $handler;
        $this->flashBag = $flashBag;
        $this->security = $security;
    }

    public function __invoke(Request $request): ?Response
    {
        if ($this->security->currentUser() !== null) {
            return $this->responseFactory->redirect('/');
        }

        try {
            $command = new Command(
                $request->request()->get('email', ''),
                $request->request()->get('password', '')
            );

            $this->handler->handle($command);

            $this->flashBag->add(FlashBag::SUCCESS, 'Signed up successfully');

            return $this->responseFactory->redirect('/signin');
        } catch (InvalidArgumentException | DomainException $exception) {
            $this->flashBag->add(FlashBag::ERROR, $exception->getMessage());

            return $this->responseFactory->redirect('/signup');
        }
    }
}
