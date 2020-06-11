<?php

namespace src\Posts\Application\Queries;

use src\Posts\Domain\Models\Post;
use src\Posts\Domain\Queries\GetPost;
use src\Posts\Domain\Queries\GetPostHandlerInterface;
use src\Posts\Domain\Repositories\PostRepositoryInterface;

class GetPostHandler implements GetPostHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(GetPost $query): Post
    {
        return $this->postRepository->findByIdOrFail($query->postId);
    }
}
