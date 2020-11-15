<?php

declare(strict_types=1);

namespace App\Domain\User\Gateway;

use App\Domain\User\Entity\User;

interface UserGateway
{
    public function register(User $user): void;

    public function findOneByEmail(string $email): ?User;

    public function findOneByNickname(string $nickname): ?User;
}
