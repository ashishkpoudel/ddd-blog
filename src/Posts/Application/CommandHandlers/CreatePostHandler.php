<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Illuminate\Support\Str;
use Weblog\Posts\Domain\Commands\CreatePost;
use Weblog\Posts\Domain\Models\Post;
use Weblog\Posts\Domain\Repositories\PostRepository;

final class CreatePostHandler
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(CreatePost $command): void
    {
        $post = app(Post::class, [
            'id' => $command->getPostId()->getValue(),
            'userId' => $command->getPostId()->getValue(),
            'title' => $command->getTitle(),
            'slug' => Str::slug($command->getTitle()),
            'body' => $command->getBody(),
            'publishedAt' => new \DateTimeImmutable(),
        ]);

        $this->postRepository->save($post);
    }
}
