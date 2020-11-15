<?php

declare(strict_types=1);

namespace App\Domain\User\UseCase\Registration;

interface RegistrationPresenterInterface
{
    public function present(RegistrationResponse $response): void;
}
