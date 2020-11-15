<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Factory;

use App\Domain\User\Entity\User;
use App\Infrastructure\Doctrine\Entity\DoctrineUser;

class DoctrineUserFactory
{
    public static function createDoctrineUserFromUser(User $user): DoctrineUser
    {
        $doctrineUser = new DoctrineUser();
        $doctrineUser->setNickname($user->getNickname());
        $doctrineUser->setPassword($user->getPassword());
        $doctrineUser->setEmail($user->getEmail());
        $doctrineUser->setRegisteredAt($user->getRegisteredAt());
        return $doctrineUser;
    }

    public static function createUserFromDoctrineUser(DoctrineUser $doctrineUser): User
    {
        return new User(
            $doctrineUser->getNickname(),
            $doctrineUser->getEmail(),
            $doctrineUser->getRegisteredAt(),
            $doctrineUser->getPassword()
        );
    }
}
