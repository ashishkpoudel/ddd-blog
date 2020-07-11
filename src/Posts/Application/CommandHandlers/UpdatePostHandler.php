<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Illuminate\Support\Str;
use Weblog\Posts\Domain\Commands\UpdatePost;
use Weblog\Posts\Domain\Repositories\PostRepositoryInterface;

final class UpdatePostHandler
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(UpdatePost $command): void
    {
        $post = $this->postRepository->query()->findOrFail($command->postId->getValue());

        if ($command->title !== null) {
            $post->title = $command->title;
            $post->slug = Str::slug($command->title);
        }

        if ($command->body !== null) {
            $post->body = $command->body;
        }

        $post->save();
    }
}
