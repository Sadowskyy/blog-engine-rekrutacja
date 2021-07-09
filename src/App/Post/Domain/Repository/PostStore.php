<?php

declare(strict_types=1);

namespace App\App\Post\Domain\Repository;


use App\App\Shared\Infrastructure\Peristance\Read\Repository\MySqlRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class PostStore implements PostRepositoryInterface
{
    private EntityRepository $objectRepository;

    private EntityManagerInterface $entityManager;

    private EntityRepository $repository;

    public function __construct(EntityRepository $objectRepository, EntityManagerInterface $entityManager, EntityRepository $repository)
    {
        $this->objectRepository = $objectRepository;
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    public function get(int $postId): Post
    {
        $this->objectRepository
            ->createQueryBuilder('post')
            ->where('post.id = :id')
            ->setParameter('id', $postId);
    }

    public function store(Post $post): void
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }
}