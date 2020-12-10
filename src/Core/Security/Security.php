<?php

declare(strict_types=1);

namespace App\Core\Security;

use App\Core\Security\Exception\InvalidCredentialsException;
use App\Core\Security\Password\PasswordEncoder;
use App\Core\Session\SessionInterface;

final class Security
{
    private const SESSION_KEY = 'user';

    private $session;

    private $passwordEncoder;

    private $userProvider;

    public function __construct(
        SessionInterface $session,
        PasswordEncoder $passwordEncoder,
        AuthUserProviderInterface $userProvider
    )
    {
        $this->session = $session;
        $this->passwordEncoder = $passwordEncoder;
        $this->userProvider = $userProvider;
    }

    public function authentication(string $email, string $password): void
    {
        $authUser = $this->userProvider->loadByEmail($email);

        if (!$authUser) {
            throw new InvalidCredentialsException();
        }

        if (!$this->passwordEncoder->match($password, $authUser->getPassword())) {
            throw new InvalidCredentialsException();
        }

        $this->session->put(self::SESSION_KEY, $authUser);
    }

    public function currentUser(): ?AuthUserInterface
    {
        return $this->session->get(self::SESSION_KEY);
    }

    public function logout(): void
    {
        $this->session->remove(self::SESSION_KEY);
    }
}
