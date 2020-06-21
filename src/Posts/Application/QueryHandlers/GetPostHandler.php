<?php

namespace Weblog\Posts\Application\QueryHandlers;

use Weblog\Posts\Domain\Models\PostInterface;
use Weblog\Posts\Domain\Queries\GetPost;
use Weblog\Posts\Domain\Repositories\PostRepositoryInterface;

final class GetPostHandler
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(GetPost $query): PostInterface
    {
        return $this->postRepository->findByIdOrFail($query->postId);
    }
}
