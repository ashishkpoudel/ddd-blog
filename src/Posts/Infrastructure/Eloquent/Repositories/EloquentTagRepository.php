<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Weblog\Posts\Domain\Models\Tag;
use Weblog\Posts\Domain\Repositories\TagRepositoryInterface;
use Weblog\Posts\Infrastructure\Eloquent\Mappers\TagMapper;
use Weblog\Posts\Infrastructure\Eloquent\Models\TagModel;

final class EloquentTagRepository implements TagRepositoryInterface
{
    private TagModel $tagModel;

    public function __construct(TagModel $model)
    {
        $this->tagModel = $model;
    }

    public function query(): Builder
    {
        return $this->tagModel->newQuery();
    }

    public function save(Tag $tag): void
    {
        $model = $this->query()->find($tag->getId()->getValue());

        if ($model) {
            $model->update(
                TagMapper::toPersistence($tag)
            );
            return;
        }

        $this->query()->create(
            TagMapper::toPersistence($tag)
        );
    }
}
