<?php

namespace src\Posts\Application\CommandHandlers;

use src\Posts\Domain\Commands\PublishPost;
use src\Posts\Domain\Repositories\PostRepositoryInterface;

final class PublishPostHandler
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
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
