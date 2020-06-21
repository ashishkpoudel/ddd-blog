<?php

namespace Weblog\Posts\Infrastructure\Http\Controllers;

use Weblog\Core\Http\Controllers\BaseController;
use Weblog\Core\Http\Response\OkResponse;
use Weblog\Posts\Domain\Queries\GetPost;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Posts\Infrastructure\Http\Resources\PostResource;

final class GetPostController extends BaseController
{
    public function __invoke($postId)
    {
        $post = $this->queryBus()->query(
            new GetPost(PostId::fromString($postId))
        );

        return new OkResponse(
            PostResource::make($post)
        );
    }
}
