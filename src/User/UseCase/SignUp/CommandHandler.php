<?php

declare(strict_types=1);

namespace App\User\UseCase\SignUp;

use App\Core\Asset\Assert;
use App\User\Entity\UserRepositoryInterface;
use DomainException;

final class CommandHandler
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Command $command): void
    {
        Assert::email($command->getEmail());
        Assert::minStringLength($command->getPassword(), 6, 'Password must be at least 6 chars');

        if ($this->userRepository->hasByEmail($command->getEmail())) {
            throw new DomainException('Email already taken');
        }
    }
}
