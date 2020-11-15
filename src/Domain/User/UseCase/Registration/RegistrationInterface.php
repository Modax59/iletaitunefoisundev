<?php

declare(strict_types=1);

namespace App\Domain\User\UseCase\Registration;

interface RegistrationInterface
{
    public function execute(RegistrationRequest $request, RegistrationPresenterInterface $presenter): void;
}
