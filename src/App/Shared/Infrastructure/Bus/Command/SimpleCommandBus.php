<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Bus\Command;


use App\App\Shared\Application\Command\CommandBusInterface;
use App\App\Shared\Application\Command\CommandInterface;

class SimpleCommandBus implements CommandBusInterface
{

    public function handle(CommandInterface $command)
    {

    }
}