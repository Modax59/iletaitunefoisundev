<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\User\Entity\User;
use App\Domain\User\Gateway\UserGateway;
use App\Infrastructure\Doctrine\Entity\DoctrineUser;
use App\Infrastructure\Doctrine\Factory\DoctrineUserFactory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrineUser::class);
    }

    public function register(User $user): void
    {
        $doctrineUser = DoctrineUserFactory::createDoctrineUserFromUser($user);
        $this->_em->persist($doctrineUser);
        $this->_em->flush();
    }

    public function findOneByEmail(string $email): ?User
    {
        /** @var DoctrineUser $doctrineUser */
        $doctrineUser = $this->findOneBy(["email" => $email]);

        if ($doctrineUser === null) {
            return null;
        }

        return DoctrineUserFactory::createUserFromDoctrineUser($doctrineUser);
    }

    public function findOneByNickname(string $nickname): ?User
    {
        /** @var DoctrineUser $doctrineUser */
        $doctrineUser = $this->findOneBy(["nickname" => $nickname]);

        if ($doctrineUser === null) {
            return null;
        }

        return DoctrineUserFactory::createUserFromDoctrineUser($doctrineUser);
    }
}
