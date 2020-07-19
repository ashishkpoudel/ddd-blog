<?php

namespace Weblog\Posts\Infrastructure\Http\Controllers;

use Weblog\Core\Http\Controllers\BaseController;
use Weblog\Core\Http\Response\CreatedResponse;
use Weblog\Posts\Domain\Commands\CreatePost;
use Weblog\Posts\Infrastructure\Http\Requests\PostRequest;
use Weblog\Posts\Infrastructure\Http\Resources\PostResource;
use Weblog\Posts\Domain\Queries\GetPost;
use Symfony\Component\Uid\Uuid;

final class CreatePostController extends BaseController
{
    public function __invoke(PostRequest $request)
    {
        $postId = Uuid::v4();
        $userId = $request->user()->id;

        $this->commandBus()->execute(
            app(CreatePost::class, [
                'postId' => $postId,
                'userId' => $userId,
                'title' => $request->input('title'),
                'body' => $request->input('body'),
                'tagIds' => $request->has('tagIds') ? $request->get('tagIds') : [],
            ])
        );

        $post = $this->queryBus()->query(new GetPost($postId));

        return new CreatedResponse(
            PostResource::make($post)
        );
    }
}
