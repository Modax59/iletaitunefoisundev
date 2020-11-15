<?php

declare(strict_types=1);

namespace App\Domain\User\UserInterface\ViewModel;

use App\Domain\User\Entity\User;
use App\Domain\User\UseCase\Registration\RegistrationResponse;

class RegistrationViewModel
{
    private User $user;

    public static function createFromResponse(RegistrationResponse $response): RegistrationViewModel
    {
        $viewModel = new self();
        $viewModel->user = $response->getUser();
        return $viewModel;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
