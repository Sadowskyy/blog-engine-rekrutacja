<?php

declare(strict_types=1);

namespace App\App\Post\Domain\Repository;


use Doctrine\ORM\EntityManagerInterface;
use App\App\Post\Domain\Post;

final class PostStore implements PostRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(int $postId): Post
    {
         $this->entityManager
            ->createQueryBuilder()
            ->select('post')
            ->from('post', 'post')
            ->where('post.id = :id')
            ->setParameter('id', $postId);
    }

    public function store(Post $post): void
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();
    }

    public function remove(Post $post): void
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}