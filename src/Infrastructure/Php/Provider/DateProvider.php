<?php

declare(strict_types=1);

namespace App\Infrastructure\Php\Provider;

use App\Domain\Shared\Provider\DateProviderInterface;
use DateTimeImmutable;

class DateProvider implements DateProviderInterface
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
