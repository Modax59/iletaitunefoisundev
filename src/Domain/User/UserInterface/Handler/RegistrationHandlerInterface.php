<?php

declare(strict_types=1);

namespace App\Domain\User\UserInterface\Handler;

use App\Domain\User\UseCase\Registration\RegistrationRequest;
use Symfony\Component\HttpFoundation\Request;

interface RegistrationHandlerInterface
{
    public function handle(Request $request, RegistrationRequest $data): bool;
}
