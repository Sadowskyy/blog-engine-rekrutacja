<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Peristance\Read\Repository;


use App\App\Shared\Infrastructure\Peristance\Read\Exception\ResourceNotFoundException;
use App\Shared\Infrastructure\Persistence\ReadModel\Exception\NotFoundException;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class MySqlRepository
{
    protected EntityManagerInterface $entityManager;

    protected EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager, EntityRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    protected function oneOrException(QueryBuilder $queryBuilder, int $hydration = AbstractQuery::HYDRATE_OBJECT)
    {
        $model = $queryBuilder
            ->getQuery()
            ->getOneOrNullResult($hydration);

        if (null === $model) {
            throw new ResourceNotFoundException();
        }

        return $model;
    }

    public function register($model): void
    {
        $this->entityManager->persist($model);
        $this->apply();
    }

    public function apply(): void
    {
        $this->entityManager->flush();
    }
}