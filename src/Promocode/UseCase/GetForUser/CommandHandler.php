<?php

declare(strict_types=1);

namespace App\Promocode\UseCase\GetForUser;

use App\Promocode\Entity\Promocode;
use App\Promocode\Entity\PromocodeRepositoryInterface;
use App\Promocode\Exception\NoAvailablePromocodeExceptions;

final class CommandHandler
{
    private $promocodeRepository;

    public function __construct(PromocodeRepositoryInterface $promocodeRepository)
    {
        $this->promocodeRepository = $promocodeRepository;
    }

    public function handle(Command $command): Promocode
    {
        $promocode = $this->promocodeRepository->findByUserId($command->getUserId());

        if ($promocode) {
            return $promocode;
        }

        $this->promocodeRepository->takeForUserId($command->getUserId());

        $promocode = $this->promocodeRepository->findByUserId($command->getUserId());

        if (!$promocode) {
            throw new NoAvailablePromocodeExceptions("Promocodes are over");
        }

        return $promocode;
    }
}
