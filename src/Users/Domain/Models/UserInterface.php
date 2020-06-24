<?php

namespace Weblog\Users\Domain\Models;

use Weblog\Users\Domain\ValueObjects\UserId;

interface UserInterface
{
    public function getId(): UserId;
    public function getName(): string;
    public function getEmailAddress(): string;
    public function getEmailVerifiedAt(): ?\DateTimeImmutable;
    public function getConfirmedAt(): ?\DateTimeImmutable;
    public function getPassword(): string;
}
