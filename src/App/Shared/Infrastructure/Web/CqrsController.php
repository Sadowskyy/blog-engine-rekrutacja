<?php


namespace App\App\Shared\Infrastructure\Web;

use App\App\Shared\Application\Command\CommandBusInterface;
use App\App\Shared\Application\Command\CommandInterface;
use App\App\Shared\Application\Query\QueryBusInterface;
use App\App\Shared\Application\Query\QueryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class CqrsController extends AbstractController
{
    private CommandBusInterface $commandBus;

    private QueryBusInterface $queryBus;

    public function __construct(CommandBusInterface $commandBus, QueryBusInterface $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    protected function ask(QueryInterface $query): mixed
    {
        return $this->queryBus->ask($query);
    }

    protected function handle(CommandInterface $command): void
    {
        $this->commandBus->handle($command);
    }
}