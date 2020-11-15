<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Security\Encoder;

use App\Domain\User\Encoder\PasswordEncoderInterface;
use App\Infrastructure\Symfony\Security\SecurityUser;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class PasswordEncoder implements PasswordEncoderInterface
{
    private EncoderFactoryInterface $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function encodePassword(string $plainPassword): string
    {
        return $this->encoderFactory->getEncoder(SecurityUser::class)->encodePassword($plainPassword, null);
    }
}
