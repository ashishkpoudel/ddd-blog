<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Weblog\Posts\Domain\Commands\DeletePost;
use Weblog\Posts\Domain\Repositories\PostRepositoryInterface;

final class DeletePostHandler
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(DeletePost $command): void
    {
        $post = $this->postRepository->query()->findOrFail($command->postId->getValue());
        $post->delete();
    }
}
