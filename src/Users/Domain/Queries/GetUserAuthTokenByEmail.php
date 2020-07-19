<?php

namespace Weblog\Users\Domain\Queries;

use Weblog\Core\Bus\Query\QueryInterface;

final class GetUserAuthTokenByEmail implements QueryInterface
{
    private string $emailAddress;

    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }
}
