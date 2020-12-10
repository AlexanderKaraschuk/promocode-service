<?php

declare(strict_types=1);

namespace App\UI\Http\Action\User;

use App\Core\Asset\Assert;
use App\Core\Asset\InvalidArgumentException;
use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Security\Exception\InvalidCredentialsException;
use App\Core\Security\Security;
use App\Core\Session\FlashBag;
use App\UI\Http\Action\ActionInterface;

final class SignInAction implements ActionInterface
{
    private $responseFactory;

    private $security;

    private $flashBag;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        Security $security,
        FlashBag $flashBag
    )
    {
        $this->responseFactory = $responseFactory;
        $this->security = $security;
        $this->flashBag = $flashBag;
    }

    public function __invoke(Request $request): ?Response
    {
        if ($this->security->currentUser() !== null) {
            return $this->responseFactory->redirect('/');
        }

        try {
            $email = $request->request()->get('email', '');
            $password = $request->request()->get('password', '');

            Assert::email($email);
            Assert::minStringLength($password, 6, 'Password must be at least 6 chars');

            $this->security->authentication($email, $password);

            return $this->responseFactory->redirect('/');
        } catch (InvalidCredentialsException $exception) {
            $this->flashBag->add(FlashBag::ERROR, 'Email or Password are invalid.');

            return $this->responseFactory->redirect('/signin');
        } catch (InvalidArgumentException $exception) {
            $this->flashBag->add(FlashBag::ERROR, $exception->getMessage());

            return $this->responseFactory->redirect('/signin');
        }
    }
}
