<?php

namespace src\Posts\Application\Commands;

use Illuminate\Log\Logger;
use Illuminate\Support\Str;
use src\Posts\Domain\Commands\UpdatePost;
use src\Posts\Domain\Exceptions\CannotUpdatePostException;
use src\Posts\Domain\Models\PostModel;

class UpdatePostHandler
{
    public Logger $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function handle(UpdatePost $command): void
    {
        try {
            $post = PostModel::query()->findOrFail($command->postId->getValue());

            if ($command->title !== null) {
                $post->title = $command->title;
                $post->slug = Str::slug($command->title);
            }

            if ($command->body !== null) {
                $post->body = $command->body;
            }

            $post->save();
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTraceAsString());
            throw new CannotUpdatePostException(
                'Unable to update post'
            );
        }
    }
}
