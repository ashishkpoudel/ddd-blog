<?php

namespace src\Posts\Infrastructure\Http\Controllers;

use src\Core\Http\Controllers\BaseController;
use src\Core\Http\Response\UpdatedResponse;
use src\Posts\Domain\Commands\UpdatePost;
use src\Posts\Infrastructure\Http\Requests\PostRequest;
use src\Posts\Infrastructure\Http\Resources\PostResource;
use src\Posts\Domain\Queries\GetPost;
use src\Posts\Domain\ValueObjects\PostId;

final class UpdatePostController extends BaseController
{
    public function __invoke(string $postId, PostRequest $request)
    {
        $postId = PostId::fromString($postId);
        $this->commandBus()->execute(
            app(UpdatePost::class, [
                'postId' => $postId,
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ])
        );

        $post = $this->queryBus()->query(new GetPost($postId));

        return new UpdatedResponse(
            PostResource::make($post)
        );
    }
}
