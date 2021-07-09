<?php

declare(strict_types=1);

namespace App\App\Comment\Domain\Repository;


use App\App\Comment\Domain\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class CommentStore implements CommentRepositoryInterface
{
    private EntityRepository $objectRepository;

    private EntityManagerInterface $entityManager;

    private EntityRepository $repository;

    public function get(int $commentId): Comment
    {
        $this->objectRepository
            ->createQueryBuilder('comment')
            ->where('comment.id = :id')
            ->setParameter('id', $commentId);
    }

    public function store(Comment $comment): void
    {
        $this->entityManager->persist($comment);
        $this->entityManager->flush();
    }

    public function remove(Comment $comment): void
    {
        $this->entityManager->remove($comment);
        $this->entityManager->flush();
    }
}