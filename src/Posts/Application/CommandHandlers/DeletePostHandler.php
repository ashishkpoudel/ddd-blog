<?php

namespace src\Posts\Application\CommandHandlers;

use Illuminate\Log\Logger;
use src\Posts\Domain\Commands\DeletePost;
use src\Posts\Domain\Exceptions\CannotDeletePostException;
use src\Posts\Domain\Repositories\PostRepositoryInterface;

final class DeletePostHandler
{
    private Logger $logger;
    private PostRepositoryInterface $postRepository;

    public function __construct(Logger $logger, PostRepositoryInterface $postRepository)
    {
        $this->logger = $logger;
        $this->postRepository = $postRepository;
    }

    public function handle(DeletePost $command): void
    {
        try {
            $post = $this->postRepository->query()->findOrFail($command->postId->getValue());
            $post->delete();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
            throw new CannotDeletePostException(
                'Unable to delete post'
            );
        }
    }
}
