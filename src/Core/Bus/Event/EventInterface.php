<?php

namespace src\Core\Bus\Event;

use DateTimeImmutable;

interface EventInterface
{
    public function createdAt(): DateTimeImmutable;
}
