<?php

declare(strict_types=1);

namespace App\UI\Http\Action\Promocode;

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Security\Security;
use App\Core\Session\FlashBag;
use App\Promocode\Exception\NoAvailablePromocodeExceptions;
use App\Promocode\UseCase\GetForUser\Command;
use App\Promocode\UseCase\GetForUser\CommandHandler;
use App\UI\Http\Action\ActionInterface;

class GetPromocodeAction implements ActionInterface
{
    private $responseFactory;

    private $security;

    private $handler;

    private $partnerUrl;

    private $flashBag;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        Security $security,
        CommandHandler $handler,
        string $partnerUrl,
        FlashBag $flashBag
    )
    {
        $this->responseFactory = $responseFactory;
        $this->security = $security;
        $this->handler = $handler;
        $this->partnerUrl = $partnerUrl;
        $this->flashBag = $flashBag;
    }

    public function __invoke(Request $request): ?Response
    {
        $currentUser = $this->security->currentUser();

        if (!$currentUser) {
            return $this->responseFactory->redirect('/signin');
        }

        try {
            $command = new Command($currentUser->getId());

            $promocode = $this->handler->handle($command);

            $url = sprintf("%s?%s", $this->partnerUrl, http_build_query(['query' => $promocode->getValue()]));

            return $this->responseFactory->redirect($url);
        } catch (NoAvailablePromocodeExceptions $exception) {
            $this->flashBag->add(FlashBag::ERROR, $exception->getMessage());

            return $this->responseFactory->redirect('/');
        }
    }
}
