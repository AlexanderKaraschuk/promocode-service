<?php

declare(strict_types=1);

namespace App\UI\Http\Action\Promocode;

use App\Core\Request\Request;
use App\Core\Response\Response;
use App\Core\Response\ResponseFactoryInterface;
use App\Promocode\UseCase\GetForUser\Command;
use App\Promocode\UseCase\GetForUser\CommandHandler;
use App\UI\Http\Action\ActionInterface;
use Throwable;

class GetPromocodeBenchmarkAction implements ActionInterface
{
    private $responseFactory;

    private $handler;

    public function __construct(
        ResponseFactoryInterface $responseFactory,
        CommandHandler $handler
    )
    {
        $this->responseFactory = $responseFactory;
        $this->handler = $handler;
    }

    public function __invoke(Request $request): ?Response
    {
        try {
            $command = new Command(random_int(1, 100000));
            $this->handler->handle($command);

            return $this->responseFactory->empty(200);
        } catch (Throwable $exception) {
            return $this->responseFactory->empty(500);
        }
    }
}
