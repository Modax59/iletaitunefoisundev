<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Responder;

use App\Domain\User\UserInterface\Responder\RegistrationResponderInterface;
use App\Domain\User\UserInterface\ViewModel\RegistrationViewModel;
use App\Infrastructure\Symfony\Handler\RegistrationHandler;
use App\Infrastructure\Symfony\Security\Guard\WebAuthenticator;
use App\Infrastructure\Symfony\Security\SecurityUser;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Twig\Environment;

class RegistrationResponder implements RegistrationResponderInterface
{
    private RequestStack $requestStack;

    private GuardAuthenticatorHandler $guardAuthenticatorHandler;

    private WebAuthenticator $webAuthenticator;

    private Environment $twig;

    private RegistrationHandler $handler;

    public function __construct(
        RequestStack $requestStack,
        GuardAuthenticatorHandler $guardAuthenticatorHandler,
        WebAuthenticator $webAuthenticator,
        Environment $twig,
        RegistrationHandler $handler
    ) {
        $this->requestStack = $requestStack;
        $this->guardAuthenticatorHandler = $guardAuthenticatorHandler;
        $this->webAuthenticator = $webAuthenticator;
        $this->twig = $twig;
        $this->handler = $handler;
    }

    public function render(): Response
    {
        return new Response($this->twig->render("ui/registration.html.twig", [
            "form" => $this->handler->getForm()->createView()
        ]));
    }

    public function authenticate(RegistrationViewModel $viewModel): Response
    {
        return $this->guardAuthenticatorHandler->authenticateUserAndHandleSuccess(
            new SecurityUser(
                $viewModel->getUser()->getEmail(),
                $viewModel->getUser()->getPassword()
            ),
            $this->requestStack->getCurrentRequest(),
            $this->webAuthenticator,
            "main"
        );
    }
}
