<?php

namespace src\Posts\Domain\Entities;

use src\Posts\Domain\ValueObjects\TagId;

interface TagInterface
{
    public function getId(): TagId;
    public function getName(): string;
}
