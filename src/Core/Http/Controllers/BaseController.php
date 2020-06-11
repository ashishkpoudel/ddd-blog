<?php

namespace src\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use src\Core\Bus\Command\CommandBus;
use src\Core\Bus\Event\EventBus;
use src\Core\Bus\Query\QueryBus;

abstract class BaseController extends Controller
{
    use AuthorizesRequests;

    public function commandBus(): CommandBus
    {
        return app(CommandBus::class);
    }

    public function eventBus(): EventBus
    {
        return app(EventBus::class);
    }

    public function queryBus(): QueryBus
    {
        return app(QueryBus::class);
    }
}
