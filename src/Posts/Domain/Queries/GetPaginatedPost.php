<?php

namespace src\Posts\Domain\Queries;

use src\Core\Bus\Query\QueryInterface;
use src\Core\Support\QueryOptions;

final class GetPaginatedPost implements QueryInterface
{
    public QueryOptions $query;

    public function __construct(QueryOptions $queryOptions)
    {
        $this->query = $queryOptions;
    }
}
