<?php

namespace src\Users\Domain\Queries;

use src\Core\Bus\Query\QueryInterface;

final class GetUserAuthTokenByEmail implements QueryInterface
{
    public string $emailAddress;

    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }
}
