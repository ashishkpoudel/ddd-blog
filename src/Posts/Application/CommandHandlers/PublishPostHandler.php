<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Weblog\Posts\Domain\Commands\PublishPost;
use Weblog\Posts\Domain\Repositories\PostRepository;

final class PublishPostHandler
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(PublishPost $publishPost): void
    {
        $post = $this->postRepository->findByIdOrFail($publishPost->postId);
        $post->markAsPublished();
        $this->postRepository->save($post);
    }
}
