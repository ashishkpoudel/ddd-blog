<?php

namespace src\Core\Bus\Command;

use Illuminate\Bus\Dispatcher;

final class CommandBus
{
    private Dispatcher $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function execute(CommandInterface $command)
    {
        return $this->dispatcher->dispatch($command);
    }
}
