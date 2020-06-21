<?php

namespace Weblog\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Weblog\Core\Bus\Command\CommandBus;
use Weblog\Core\Bus\Event\EventBus;
use Weblog\Core\Bus\Query\QueryBus;

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
