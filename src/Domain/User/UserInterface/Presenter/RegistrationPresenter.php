<?php

declare(strict_types=1);

namespace App\Domain\User\UserInterface\Presenter;

use App\Domain\User\UseCase\Registration\RegistrationResponse;
use App\Domain\User\UserInterface\ViewModel\RegistrationViewModel;

class RegistrationPresenter implements RegistrationPresenterInterface
{
    private RegistrationViewModel $viewModel;

    public function present(RegistrationResponse $response): void
    {
        $this->viewModel = RegistrationViewModel::createFromResponse($response);
    }

    public function getViewModel(): RegistrationViewModel
    {
        return $this->viewModel;
    }
}
