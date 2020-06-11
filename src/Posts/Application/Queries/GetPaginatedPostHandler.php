<?php

namespace src\Posts\Application\Queries;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use src\Posts\Domain\Queries\GetPaginatedPost;
use src\Posts\Domain\Queries\GetPaginatedPostHandlerInterface;
use src\Posts\Domain\Repositories\PostRepositoryInterface;

class GetPaginatedPostHandler implements GetPaginatedPostHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(GetPaginatedPost $query): LengthAwarePaginator
    {
        $postQuery = $this->postRepository->query();

        if (isset($query->query->filters['title'])) {
            $postQuery->where('title', 'like', '%' . $query->query->filters['title'] . '%');
        }

        if (isset($query->query->filters['slug'])) {
            $postQuery->where('slug', 'like', '%' . $query->query->filters['slug'] . '%');
        }

        return $postQuery->limit($query->query->limit)->paginate($query->query->page);
    }
}
