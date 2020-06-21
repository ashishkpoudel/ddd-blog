<?php

namespace Weblog\Posts\Infrastructure\Http\Controllers;

use Weblog\Core\Http\Controllers\BaseController;
use Weblog\Core\Http\Response\CreatedResponse;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Posts\Domain\Commands\CreatePost;
use Weblog\Posts\Domain\ValueObjects\TagId;
use Weblog\Posts\Infrastructure\Http\Requests\PostRequest;
use Weblog\Posts\Infrastructure\Http\Resources\PostResource;
use Weblog\Posts\Domain\Queries\GetPost;
use Weblog\Users\Domain\ValueObjects\UserId;

final class CreatePostController extends BaseController
{
    public function __invoke(PostRequest $request)
    {
        $postId = PostId::new();
        $userId = UserId::fromString($request->user()->id);
        $tagIds = $request->has('tagIds')
            ? array_map(fn($tagId) => TagId::fromString($tagId), $request->input('tagIds'))
            : [];

        $this->commandBus()->execute(
            app(CreatePost::class, [
                'postId' => $postId,
                'userId' => $userId,
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'tagIds' => $tagIds,
            ])
        );

        $post = $this->queryBus()->query(new GetPost($postId));

        return new CreatedResponse(
            PostResource::make($post)
        );
    }
}
