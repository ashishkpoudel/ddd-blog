<?php

namespace Weblog\Users\Domain\Models;

use Weblog\Users\Domain\ValueObjects\UserId;

final class User implements UserInterface
{
    private UserId $id;
    private string $name;
    private string $emailAddress;
    private ?\DateTimeImmutable $emailVerifiedAt;
    private ?\DateTimeImmutable $confirmedAt;
    private string $password;

    public function __construct(
        UserId $id,
        string $name,
        string $emailAddress,
        ?\DateTimeImmutable $emailVerifiedAt,
        ?\DateTimeImmutable $confirmedAt,
        string $password
    ) {
        $this->setId($id);
        $this->setName($name);
        $this->setEmailAddress($emailAddress);
        $this->setEmailVerifiedAt($emailVerifiedAt);
        $this->setConfirmedAt($confirmedAt);
        $this->setPassword($password);
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    private function setId(UserId $userId): void
    {
        $this->id = $userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    private function setEmailAddress(string $emailAddress)
    {
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(
                'Invalid email address'
            );
        }

        $this->emailAddress = $emailAddress;
    }

    public function getEmailVerifiedAt(): ?\DateTimeImmutable
    {
        return $this->emailVerifiedAt;
    }

    private function setEmailVerifiedAt(?\DateTimeImmutable $emailVerifiedAt): void
    {
        $this->emailVerifiedAt = $emailVerifiedAt;
    }

    public function getConfirmedAt(): ?\DateTimeImmutable
    {
        return $this->confirmedAt;
    }

    private function setConfirmedAt(?\DateTimeImmutable $confirmedAt): void
    {
        $this->confirmedAt = $confirmedAt;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    private function setPassword(string $password): void
    {
        if (strlen($password) < 6) {
            throw new \InvalidArgumentException(
                'Password must be greater than or equal to 6 character long'
            );
        }

        $this->password = $password;
    }
}
