<?php

namespace Weblog\Posts\Application\CommandHandlers;

use Illuminate\Support\Str;
use Illuminate\Log\Logger;
use Weblog\Posts\Domain\Commands\CreatePost;
use Weblog\Posts\Domain\Exceptions\CannotCreatePostException;
use Weblog\Posts\Domain\Models\Post;
use Weblog\Posts\Domain\Repositories\PostRepositoryInterface;

final class CreatePostHandler
{
    private Logger $logger;
    private PostRepositoryInterface $postRepository;

    public function __construct(Logger $logger, PostRepositoryInterface $postRepository)
    {
        $this->logger = $logger;
        $this->postRepository = $postRepository;
    }

    public function handle(CreatePost $command): void
    {
        try {
            $post = app(Post::class, [
                'id' => $command->postId,
                'userId' => $command->userId,
                'title' => $command->title,
                'slug' => Str::slug($command->title),
                'body' => $command->body,
                'publishedAt' => new \DateTime(),
            ]);

            $this->postRepository->save($post);

        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
            throw new CannotCreatePostException(
                'Failed to create post'
            );
        }
    }
}
