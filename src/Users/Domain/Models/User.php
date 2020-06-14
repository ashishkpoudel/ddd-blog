<?php

namespace src\Users\Domain\Models;

use src\Users\Domain\ValueObjects\UserId;

class User
{
    private UserId $id;
    private string $name;
    private string $emailAddress;
    private ?\DateTime $emailVerifiedAt;
    private ?\DateTime $confirmedAt;
    private string $password;

    public function __construct(
        string $name,
        string $emailAddress,
        ?\DateTime $emailVerifiedAt,
        ?\DateTime $confirmedAt,
        string $password
    ) {
        $this->name = $name;
        $this->setEmailAddress($emailAddress);
        $this->emailVerifiedAt = $emailVerifiedAt;
        $this->confirmedAt = $confirmedAt;
        $this->setPassword($password);
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
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

    public function getEmailVerifiedAt(): ?\DateTime
    {
        return $this->emailVerifiedAt;
    }

    public function getConfirmedAt(): ?\DateTime
    {
        return $this->confirmedAt;
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
