<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Peristance\Read\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Throwable;

class MySqlDatabase
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function isHealthy(): bool
    {
        $connection = $this->entityManager->getConnection();

        try {
            $dummySelectSQL = $connection->getDatabasePlatform()->getDummySelectSQL();
            $connection->executeQuery($dummySelectSQL);

            return true;
        } catch (Throwable $exception) {
            $connection->close();
            return false;
        }
    }
}