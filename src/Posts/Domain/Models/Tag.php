<?php

namespace Weblog\Posts\Domain\Models;

use Weblog\Posts\Domain\ValueObjects\TagId;

final class Tag implements TagInterface
{
    private TagId $id;
    private string $name;

    public function __construct(TagId $id, string $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    public function getId(): TagId
    {
        return $this->id;
    }

    private function setId(TagId $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name)
    {
        if (strlen($name) === 0) {
            throw new \InvalidArgumentException(
                'Tag name cannot be empty'
            );
        }

        $this->name = $name;
    }
}
