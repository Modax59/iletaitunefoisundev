<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Domain\User\Encoder\PasswordEncoderInterface;
use App\Domain\User\Entity\User;
use App\Infrastructure\Doctrine\Entity\DoctrineUser;
use App\Infrastructure\Doctrine\Factory\DoctrineUserFactory;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private PasswordEncoderInterface $passwordEncoder;

    public function __construct(PasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User("admin", "admin@email.com", new DateTimeImmutable());
        $user->encodePassword($this->passwordEncoder, "password");
        $manager->persist(DoctrineUserFactory::createDoctrineUserFromUser($user));
        $manager->flush();
    }
}
