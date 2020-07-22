<?php

namespace Weblog\Posts\Infrastructure\Eloquent\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Weblog\Posts\Domain\Models\Tag;
use Weblog\Posts\Domain\Repositories\TagRepository;
use Weblog\Posts\Domain\ValueObjects\TagId;
use Weblog\Posts\Infrastructure\Eloquent\Models\TagModel;

final class EloquentTagRepository implements TagRepository
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
        $data = $tag->mappedData();

        $model = $this->query()->find(TagId::fromString($data['id']));

        if ($model) {
            $model->update($data);
            return;
        }

        $this->query()->create(
            $data
        );
    }
}
