<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Weblog\Posts\Domain\Models\PostInterface;
use Weblog\Posts\Domain\Repositories\PostRepositoryInterface;
use Weblog\Posts\Domain\Repositories\TagRepositoryInterface;
use Weblog\Posts\Domain\ValueObjects\PostId;
use Weblog\Posts\Infrastructure\Eloquent\Mappers\PostMapper;
use Weblog\Posts\Infrastructure\Eloquent\Models\PostModel;

final class EloquentPostRepository implements PostRepositoryInterface
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
