<?php

namespace src\Core\Support;

use Illuminate\Http\Request;

class QueryOptions
{
    public int $page;
    public int $limit;
    public array $filters;

    public function __construct(int $page, int $limit, array $filters = [])
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->filters = $filters;
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            (int) $request->input('page'),
            (int) $request->input('limit'),
            (array) $request->input('filter')
        );
    }
}
