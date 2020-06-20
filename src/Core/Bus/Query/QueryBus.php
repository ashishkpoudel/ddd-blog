<?php

namespace src\Core\Bus\Query;

use Illuminate\Bus\Dispatcher;

final class QueryBus
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public function query(QueryInterface $query)
    {
        return $this->dispatcher->dispatch($query);
    }
}
