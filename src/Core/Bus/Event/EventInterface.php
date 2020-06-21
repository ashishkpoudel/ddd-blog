<?php

namespace Weblog\Core\Bus\Event;

use DateTimeImmutable;

interface EventInterface
{
    public function createdAt(): DateTimeImmutable;
}
