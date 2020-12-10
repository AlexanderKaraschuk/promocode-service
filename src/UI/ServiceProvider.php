<?php

declare(strict_types=1);

namespace App\UI;

use App\Core\Container\ContainerInterface;
use App\Core\Container\ServiceProviderInterface;
use App\Core\Response\ResponseFactoryInterface;
use App\Core\Security\Security;
use App\Core\Session\FlashBag;
use App\Promocode\UseCase\GetForUser\CommandHandler;
use App\UI\Http\Action\IndexAction;
use App\UI\Http\Action\Promocode\GetPromocodeAction;
use App\UI\Http\Action\Promocode\GetPromocodeBenchmarkAction;
use App\UI\Http\Action\User\LogoutAction;
use App\UI\Http\Action\User\ShowSingInFormAction;
use App\UI\Http\Action\User\ShowSingUpFormAction;
use App\UI\Http\Action\User\SignInAction;
use App\UI\Http\Action\User\SignUpAction;

final class ServiceProvider implements ServiceProviderInterface
{
    public function register(ContainerInterface $container): void
    {
        $container->set(IndexAction::class);
        $container->set(ShowSingUpFormAction::class);
        $container->set(SignUpAction::class);
        $container->set(ShowSingInFormAction::class);
        $container->set(SignInAction::class);
        $container->set(LogoutAction::class);
        $container->set(GetPromocodeBenchmarkAction::class);
        $container->set(GetPromocodeAction::class, function (ContainerInterface $container) {
            return new GetPromocodeAction(
                $container->get(ResponseFactoryInterface::class),
                $container->get(Security::class),
                $container->get(CommandHandler::class),
                getenv('PARTNER_URL'),
                $container->get(FlashBag::class)
            );
        });
    }
}
