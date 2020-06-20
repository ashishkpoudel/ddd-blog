<?php

namespace src\Posts\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use src\Posts\Domain\Models\Post;
use src\Posts\Domain\Models\PostInterface;
use src\Posts\Domain\Repositories\PostRepositoryInterface;
use src\Posts\Domain\Repositories\TagRepositoryInterface;
use src\Posts\Domain\ValueObjects\PostId;
use src\Posts\Infrastructure\Eloquent\Mappers\PostMapper;
use src\Posts\Infrastructure\Eloquent\Models\PostModel;

class EloquentPostRepository implements PostRepositoryInterface
{
    private PostModel $model;
    private TagRepositoryInterface $tagRepository;

    public function __construct(PostModel $model, TagRepositoryInterface $tagRepository)
    {
        $this->model = $model;
        $this->tagRepository = $tagRepository;
    }

    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    public function findById(PostId $postId): ?PostInterface
    {
        $post = $this->query()->find($postId->getValue());

        if (!$post) {
            return null;
        }

        return PostMapper::toDomain($post->toArray());
    }

    public function findByIdOrFail(PostId $postId): PostInterface
    {
        return PostMapper::toDomain(
            $this->query()->findOrFail($postId->getValue())->toArray()
        );
    }

    public function save(PostInterface $post): void
    {
        $model = $this->query()->find($post->getId()->getValue());

        if ($model) {
            $model->update(PostMapper::toPersistence($post));
            $this->tagRepository->saveMany($post->getTags());
            return;
        }

        $this->query()->create(PostMapper::toPersistence($post));
        $this->tagRepository->saveMany($post->getTags());
    }
}
