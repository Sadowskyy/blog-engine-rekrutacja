<?php

declare(strict_types=1);

namespace App\App\Shared\Application\Command;


interface CommandBusInterface
{
    public function handle(CommandInterface $command);
}