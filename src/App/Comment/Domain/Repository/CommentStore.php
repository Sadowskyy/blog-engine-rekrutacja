<?php

declare(strict_types=1);

namespace App\App\Comment\Domain\Repository;

use App\App\Post\Domain\Repository\PostStore;
use App\App\Shared\Domain\Comment;
use App\App\Shared\Domain\Post;
use Doctrine\ORM\EntityManagerInterface;

final class CommentStore implements CommentRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    private PostStore $postStore;

    public function __construct(EntityManagerInterface $entityManager, PostStore $postStore)
    {
        $this->entityManager = $entityManager;
        $this->postStore = $postStore;
    }

    public function get(int $commentId): Comment
    {
        $sql = 'SELECT * from comment WHERE id = ?';
        $state = $this->entityManager->getConnection()->prepare($sql);
        $state->bindValue(1, $commentId);

        $state->execute();
        $comment = $state->fetchAll();

        if($comment['0'] === null){
            throw new \Exception();
        }

        return Comment::createView(
            $comment['0']['author'], $comment['0']['content'],
            $this->postStore->get((int) $comment['0']['commented_post_id'])
        );
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