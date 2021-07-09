<?php

declare(strict_types=1);

namespace App\App\Comment\Domain\Repository;


use App\App\Comment\Domain\Comment;
use Doctrine\ORM\EntityManagerInterface;

final class CommentStore implements CommentRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(int $commentId): Comment
    {
        $this->entityManager
            ->createQueryBuilder()
            ->select('comment')
            ->from('comment', 'comment')
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