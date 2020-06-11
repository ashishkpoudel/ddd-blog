<?php

namespace src\Users\Domain\Queries;

use src\Core\Bus\Query\QueryInterface;

class GetUserAuthTokenByEmail implements QueryInterface
{
    public string $emailAddress;

    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }
}
