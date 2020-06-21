<?php

namespace Weblog\Posts\Domain\Queries;

use Weblog\Core\Bus\Query\QueryInterface;
use Weblog\Core\Support\QueryOptions;

final class GetPaginatedPost implements QueryInterface
{
    public QueryOptions $query;

    public function __construct(QueryOptions $queryOptions)
    {
        $this->query = $queryOptions;
    }
}
