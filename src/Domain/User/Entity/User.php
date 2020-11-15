<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Domain\User\Encoder\PasswordEncoderInterface;
use DateTimeImmutable;

class User
{
    private string $nickname;

    private string $email;

    private ?string $password = null;

    private DateTimeImmutable $registeredAt;

    public function __construct(
        string $nickname,
        string $email,
        DateTimeImmutable $registeredAt,
        ?string $password = null
    ) {
        $this->nickname = $nickname;
        $this->email = $email;
        $this->registeredAt = $registeredAt;
        $this->password = $password;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRegisteredAt(): DateTimeImmutable
    {
        return $this->registeredAt;
    }

    public function encodePassword(PasswordEncoderInterface $passwordEncoder, string $plainPassword): void
    {
        $this->password = $passwordEncoder->encodePassword($plainPassword);
    }
}
