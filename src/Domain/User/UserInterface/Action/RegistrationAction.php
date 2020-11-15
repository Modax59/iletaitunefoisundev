<?php

declare(strict_types=1);

namespace App\Domain\User\UserInterface\Action;

use App\Domain\Shared\Exception\BadRequestException;
use App\Domain\User\UseCase\Registration\RegistrationInterface;
use App\Domain\User\UseCase\Registration\RegistrationRequest;
use App\Domain\User\UserInterface\Handler\RegistrationHandlerInterface;
use App\Domain\User\UserInterface\Presenter\RegistrationPresenterInterface;
use App\Domain\User\UserInterface\Responder\RegistrationResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrationAction
{
    private RegistrationPresenterInterface $presenter;

    private RegistrationHandlerInterface $handler;

    private RegistrationResponderInterface $responder;

    public function __construct(
        RegistrationHandlerInterface $handler,
        RegistrationPresenterInterface $presenter,
        RegistrationResponderInterface $responder
    ) {
        $this->handler = $handler;
        $this->presenter = $presenter;
        $this->responder = $responder;
    }

    public function __invoke(Request $request): Response
    {
        $registrationRequest = new RegistrationRequest();

        if ($this->handler->handle($request, $registrationRequest)) {
            return $this->responder->authenticate($this->presenter->getViewModel());
        }

        return $this->responder->render();
    }
}
