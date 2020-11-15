<?php

declare(strict_types=1);

namespace App\Domain\Shared\Provider;

use DateTimeImmutable;

interface DateProviderInterface
{
    public function now(): DateTimeImmutable;
}
