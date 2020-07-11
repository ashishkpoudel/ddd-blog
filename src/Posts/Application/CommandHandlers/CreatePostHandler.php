<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Illuminate\Support\Str;
use Weblog\Posts\Domain\Commands\CreatePost;
use Weblog\Posts\Domain\Models\Post;
use Weblog\Posts\Domain\Repositories\PostRepositoryInterface;

final class CreatePostHandler
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(CreatePost $command): void
    {
        $post = app(Post::class, [
            'id' => $command->postId,
            'userId' => $command->userId,
            'title' => $command->title,
            'slug' => Str::slug($command->title),
            'body' => $command->body,
            'publishedAt' => new \DateTimeImmutable(),
        ]);

        $this->postRepository->save($post);
    }
}
