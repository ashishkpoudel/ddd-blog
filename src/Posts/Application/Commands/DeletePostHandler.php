<?php

namespace src\Posts\Application\Commands;

use Illuminate\Log\Logger;
use src\Posts\Domain\Commands\DeletePost;
use src\Posts\Domain\Exceptions\CannotDeletePostException;
use src\Posts\Domain\Models\PostModel;

class DeletePostHandler
{
    private Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(DeletePost $command): void
    {
        try {
            $post = PostModel::query()->findOrFail($command->postId->getValue());
            $post->delete();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTraceAsString());
            throw new CannotDeletePostException(
                'Unable to delete post'
            );
        }
    }
}
