<?php

namespace src\Posts\Infrastructure\Http\Controllers;

use src\Core\Http\Controllers\BaseController;
use src\Core\Http\Response\OkResponse;
use src\Posts\Domain\Queries\GetPost;
use src\Posts\Domain\ValueObjects\PostId;
use src\Posts\Infrastructure\Http\Resources\PostResource;

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
