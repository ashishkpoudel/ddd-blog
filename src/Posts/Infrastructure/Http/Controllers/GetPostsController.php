<?php

namespace Weblog\Posts\Infrastructure\Http\Controllers;

use Illuminate\Http\Request;
use Weblog\Core\Http\Controllers\BaseController;
use Weblog\Core\Http\Response\OkResponse;
use Weblog\Core\Support\PaginatedResult;
use Weblog\Core\Support\QueryOptions;
use Weblog\Posts\Infrastructure\Http\Resources\PostResource;
use Weblog\Posts\Domain\Queries\GetPaginatedPost;

final class GetPostsController extends BaseController
{
    public function __invoke(Request $request)
    {
        /** @var PaginatedResult $posts */
        $posts = $this->queryBus()->query(new GetPaginatedPost(QueryOptions::fromRequest($request)));

        return new OkResponse(
            PostResource::collection($posts->getItems())
        );
    }
}
