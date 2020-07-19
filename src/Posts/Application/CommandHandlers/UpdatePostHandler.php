<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Illuminate\Support\Str;
use Weblog\Posts\Domain\Commands\UpdatePost;
use Weblog\Posts\Domain\Repositories\PostRepository;

final class UpdatePostHandler
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(UpdatePost $command): void
    {
        // introduce post repository update method and use it
        $post = $this->postRepository->query()->findOrFail($command->postId->getValue());

        if ($command->getTitle()) {
            $post->title = $command->getTitle();
            $post->slug = Str::slug($command->getTitle());
        }

        if ($command->getBody()) {
            $post->body = $command->getBody();
        }

        $post->save();
    }
}
