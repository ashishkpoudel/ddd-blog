<?php

namespace src\Posts\Application\QueryHandlers;

use src\Posts\Domain\Queries\GetPaginatedPost;
use src\Posts\Domain\Repositories\PostRepositoryInterface;
use src\Posts\Infrastructure\Eloquent\Mappers\PostMapper;

final class GetPaginatedPostHandler
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function handle(GetPaginatedPost $query)
    {
        $postQuery = $this->postRepository
            ->query()
            ->limit($query->query->limit);

        if (isset($query->query->filters['title'])) {
            $postQuery->where('title', 'like', '%' . $query->query->filters['title'] . '%');
        }

        if (isset($query->query->filters['slug'])) {
            $postQuery->where('slug', 'like', '%' . $query->query->filters['slug'] . '%');
        }

        return $postQuery->get()
            ->map(function($post) {
                return PostMapper::toDomain($post->toArray());
            });
    }
}
