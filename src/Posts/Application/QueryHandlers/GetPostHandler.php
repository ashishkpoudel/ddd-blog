<?php

namespace Weblog\Posts\Application\QueryHandlers;

use Weblog\Posts\Domain\Models\PostInterface;
use Weblog\Posts\Domain\Queries\GetPost;
use Weblog\Posts\Domain\Repositories\PostRepository;

final class GetPostHandler
{
    private PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(GetPost $query): PostInterface
    {
        return $this->postRepository->findByIdOrFail($query->getPostId());
    }
}
