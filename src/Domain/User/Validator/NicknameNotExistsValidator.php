<?php

declare(strict_types=1);

namespace App\Domain\User\Validator;

use App\Domain\User\Gateway\UserGateway;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NicknameNotExistsValidator extends ConstraintValidator
{
    private UserGateway $userGateway;

    public function __construct(UserGateway $userGateway)
    {
        $this->userGateway = $userGateway;
    }

    public function validate($value, Constraint $constraint)
    {
        if ($value === null || $value === '') {
            return;
        }

        $user = $this->userGateway->findOneByNickname($value);

        if ($user !== null) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
