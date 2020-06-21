<?php

namespace Weblog\Users\Domain\Models;

use Weblog\Users\Domain\ValueObjects\UserId;

interface UserInterface
{
    public function getId(): UserId;
    public function getName(): string;
    public function getEmailAddress(): string;
    public function getEmailVerifiedAt(): ?\DateTime;
    public function getConfirmedAt(): ?\DateTime;
    public function getPassword(): string;
}
