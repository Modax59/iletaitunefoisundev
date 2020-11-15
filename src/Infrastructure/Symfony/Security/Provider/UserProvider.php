<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Security\Provider;

use App\Domain\User\Gateway\UserGateway;
use App\Infrastructure\Symfony\Security\SecurityUser;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function loadUserByUsername(string $username): UserInterface
    {
        $user = $this->userGateway->findOneByEmail($username);

        if ($user === null) {
            throw new UsernameNotFoundException();
        }

        return new SecurityUser($user->getEmail(), $user->getPassword());
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        $user = $this->userGateway->findOneByEmail($user->getUsername());

        if ($user === null) {
            throw new UsernameNotFoundException();
        }

        return new SecurityUser($user->getEmail(), $user->getPassword());
    }

    public function supportsClass(string $class): bool
    {
        return SecurityUser::class === $class;
    }
}
