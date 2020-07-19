<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Weblog\Posts\Domain\Commands\DeletePost;
use Weblog\Posts\Domain\Repositories\PostRepository;

final class DeletePostHandler
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(DeletePost $command): void
    {
        $post = $this->postRepository->query()->findOrFail($command->postId->getValue());
        $post->delete();
    }
}
