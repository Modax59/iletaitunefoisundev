<?php

declare(strict_types=1);

namespace App\Domain\User\UseCase\Registration;

use App\Domain\Shared\Exception\BadRequestException;
use App\Domain\User\Validator\EmailNotExists;
use App\Domain\User\Validator\NicknameNotExists;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationRequest
{
    public string $nickname;

    public string $email;

    public string $password;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraints("nickname", [
            new NotBlank(),
            new NicknameNotExists()
        ]);
        $metadata->addPropertyConstraints("email", [
            new Email(),
            new NotBlank(),
            new EmailNotExists()
        ]);
        $metadata->addPropertyConstraints("password", [
            new Length(["min" => 8]),
            new NotBlank(),
        ]);
    }

    public function validate(ValidatorInterface $validator): void
    {
        $constraintViolationList = $validator->validate($this);

        if ($constraintViolationList->count() > 0) {
            throw new BadRequestException($constraintViolationList);
        }
    }
}
