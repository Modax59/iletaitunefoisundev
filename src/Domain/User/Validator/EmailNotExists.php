<?php

declare(strict_types=1);

namespace App\Domain\User\Validator;

use Symfony\Component\Validator\Constraint;

class EmailNotExists extends Constraint
{
    public string $message = "Cette adresse email existe déjà.";
}
