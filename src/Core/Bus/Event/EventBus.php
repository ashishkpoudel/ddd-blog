<?php

namespace src\Core\Bus\Event;

use Illuminate\Events\Dispatcher;

final class EventBus
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param EventInterface $event
     * @return mixed
     */
    public function publish(EventInterface $event)
    {
        return $this->dispatcher->dispatch($event);
    }
}
