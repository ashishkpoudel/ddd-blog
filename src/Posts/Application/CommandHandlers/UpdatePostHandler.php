<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Illuminate\Support\Str;
use Weblog\Posts\Domain\Commands\UpdatePost;
use Weblog\Posts\Domain\Models\Post;
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
        $post = $this->postRepository->findByIdOrFail($command->getPostId());

        $updatedPost = app(Post::class, [
            'id' => $post->getId(),
            'title' => $command->getTitle() ?? $post->getTitle(),
            'slug' => $command->getTitle() ? Str::slug($command->getTitle()) : $post->getSlug(),
            'body' => $command->getBody() ?? $post->getBody(),
        ]);

        $this->postRepository->save($updatedPost);
    }
}
