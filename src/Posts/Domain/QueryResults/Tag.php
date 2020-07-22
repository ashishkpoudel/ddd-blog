<?php

namespace Weblog\Posts\Domain\QueryResults;

use Weblog\Posts\Domain\ValueObjects\TagId;

final class Tag
{
    private TagId $id;
    private string $name;

    public function __construct(TagId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): TagId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
