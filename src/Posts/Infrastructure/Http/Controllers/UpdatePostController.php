<?php

namespace Weblog\Posts\Infrastructure\Http\Controllers;

use Weblog\Core\Http\Controllers\BaseController;
use Weblog\Core\Http\Response\UpdatedResponse;
use Weblog\Posts\Domain\Commands\UpdatePost;
use Weblog\Posts\Domain\ValueObjects\TagId;
use Weblog\Posts\Infrastructure\Http\Requests\PostRequest;
use Weblog\Posts\Infrastructure\Http\Resources\PostResource;
use Weblog\Posts\Domain\Queries\GetPost;
use Weblog\Posts\Domain\ValueObjects\PostId;

final class UpdatePostController extends BaseController
{
    public function __invoke(string $postId, PostRequest $request)
    {
        $postId = PostId::fromString($postId);
        $tagIds = array_map(fn($tagId) => TagId::fromString($tagId), $request->input('tagIds'));

        $this->commandBus()->execute(
            app(UpdatePost::class, [
                'postId' => $postId,
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'tagIds' => $tagIds,
            ])
        );

        $post = $this->queryBus()->query(new GetPost($postId));

        return new UpdatedResponse(
            PostResource::make($post)
        );
    }
}
