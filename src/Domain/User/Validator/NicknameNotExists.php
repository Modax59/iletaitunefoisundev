<?php

declare(strict_types=1);

namespace App\Domain\User\Validator;

use Symfony\Component\Validator\Constraint;

class NicknameNotExists extends Constraint
{
    public string $message = "Ce pseudo existe déjà.";
}
