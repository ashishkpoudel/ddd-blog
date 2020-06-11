<?php

namespace src\Posts\Domain\Queries;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GetPaginatedPostHandlerInterface
{
    public function handle(GetPaginatedPost $query): LengthAwarePaginator;
}
