<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Bus\Query;


use App\App\Shared\Application\Query\QueryBusInterface;
use App\App\Shared\Application\Query\QueryInterface;

class SimpleQueryBus implements QueryBusInterface
{

    public function ask(QueryInterface $query): mixed
    {

    }
}