<?php

namespace Weblog\Posts\Domain\Models;

use Weblog\Posts\Domain\ValueObjects\TagId;

interface TagInterface
{
    public function getId(): TagId;
    public function getName(): string;
}
