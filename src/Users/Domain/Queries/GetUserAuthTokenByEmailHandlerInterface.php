<?php

namespace src\Users\Domain\Queries;

use src\Users\Domain\Queries\GetUserAuthTokenByEmail;

interface GetUserAuthTokenByEmailHandlerInterface
{
    public function handle(GetUserAuthTokenByEmail $query): array;
}
