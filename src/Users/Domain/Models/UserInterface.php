<?php

namespace src\Users\Domain\Models;

use src\Users\Domain\ValueObjects\UserId;

interface UserInterface
{
    public function getId(): UserId;
    public function getName(): string;
    public function getEmailAddress(): string;
    public function getEmailVerifiedAt(): ?\DateTime;
    public function getConfirmedAt(): ?\DateTime;
    public function getPassword(): string;
}
