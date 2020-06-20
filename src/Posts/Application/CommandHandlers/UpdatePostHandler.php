<?php

namespace src\Posts\Application\CommandHandlers;

use Illuminate\Log\Logger;
use Illuminate\Support\Str;
use src\Posts\Domain\Commands\UpdatePost;
use src\Posts\Domain\Exceptions\CannotUpdatePostException;
use src\Posts\Domain\Repositories\PostRepositoryInterface;

final class UpdatePostHandler
{
    public Logger $logger;
    private PostRepositoryInterface $postRepository;

    public function __construct(Logger $logger, PostRepositoryInterface $postRepository)
    {
        $this->logger = $logger;
        $this->postRepository = $postRepository;
    }

    public function handle(UpdatePost $command): void
    {
        try {
            $post = $this->postRepository->query()->findOrFail($command->postId->getValue());

            if ($command->title !== null) {
                $post->title = $command->title;
                $post->slug = Str::slug($command->title);
            }

            if ($command->body !== null) {
                $post->body = $command->body;
            }

            $post->save();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
            throw new CannotUpdatePostException(
                'Unable to update post'
            );
        }
    }
}
