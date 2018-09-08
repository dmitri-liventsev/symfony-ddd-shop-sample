<?php

namespace App\UI\Http\Rest\Controller;

use League\Tactician\CommandBus;

abstract class CommandController
{
    protected function exec($command): void
    {
        $this->commandBus->handle($command);
    }

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @var CommandBus
     */
    private $commandBus;
}
