<?php

namespace src\Posts\Application\Commands;

use Illuminate\Support\Str;
use Illuminate\Log\Logger;
use src\Posts\Domain\Commands\CreatePost;
use src\Posts\Domain\Exceptions\CannotCreatePostException;
use src\Posts\Domain\Entities\Post;
use src\Posts\Domain\Repositories\PostRepositoryInterface;

class CreatePostHandler
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
                'tagIds' => $command->tagIds,
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
