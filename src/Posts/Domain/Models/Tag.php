<?php

namespace Weblog\Posts\Domain\Models;

use Weblog\Posts\Domain\ValueObjects\TagId;

final class Tag
{
    private TagId $id;
    private string $name;

    public function __construct(TagId $id, string $name)
    {
        $this->setId($id);
        $this->setName($name);
    }

    private function setId(TagId $id): void
    {
        $this->id = $id;
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

    public function mappedData(): array
    {
        return [
            'id' => $this->id->getValue(),
            'name' => $this->name,
        ];
    }
}
