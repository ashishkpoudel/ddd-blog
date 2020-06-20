<?php

namespace src\Core\Support;

use Illuminate\Http\Request;

class QueryOptions
{
    public int $page;
    public int $limit;
    public array $filters;

    private function __construct(int $page, int $limit, array $filters = [])
    {
        $this->page = $page;
        $this->limit = $limit;
        $this->filters = $filters;
    }

    public static function fromRequest(Request $request)
    {
        return new self(
            $request->has('page') ? (int) $request->input('page') : 1,
            $request->has('limit') ? (int) $request->input('limit') : 15,
            $request->has('filter') ? (array) $request->input('filter') : []
        );
    }
}
