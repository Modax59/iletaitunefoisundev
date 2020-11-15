<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Handler;

use App\Domain\Shared\Exception\BadRequestException;
use App\Domain\User\UserInterface\Handler\RegistrationHandler as BaseHandler;
use App\Domain\User\UseCase\Registration\RegistrationRequest;
use App\Domain\User\UserInterface\Handler\RegistrationHandlerInterface;
use App\Infrastructure\Symfony\Form\RegistrationType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationInterface;

class RegistrationHandler extends BaseHandler implements RegistrationHandlerInterface
{
    private FormInterface $form;

    private FormFactoryInterface $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
        $this->form = $this->formFactory->create(RegistrationType::class);
    }

    public function handle(Request $request, RegistrationRequest $data): bool
    {
        $this->form->setData($data)->handleRequest($request);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            try {
                $this->process($data);
                return true;
            } catch (BadRequestException $exception) {
                /** @var ConstraintViolationInterface $constraintViolation */
                foreach ($exception->getConstraintViolationList() as $constraintViolation) {
                    $this->form->get($constraintViolation->getPropertyPath())->addError(
                        new FormError($constraintViolation->getMessage())
                    );
                }
            }
        }

        return false;
    }

    public function getForm(): FormInterface
    {
        return $this->form;
    }
}
