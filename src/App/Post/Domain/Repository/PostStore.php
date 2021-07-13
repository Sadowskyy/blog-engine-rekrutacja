<?php

declare(strict_types=1);

namespace App\App\Post\Domain\Repository;


use App\App\Shared\Domain\Post;
use Doctrine\ORM\EntityManagerInterface;

final class PostStore implements PostRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function get(int $postId): Post
    {
        $sql = 'SELECT * FROM post WHERE id = ?';
        $state = $this->entityManager->getConnection()->prepare($sql);
        $state->bindValue(1, $postId);

        $state->execute();
        $post = $state->fetchAll();

        return Post::createView(
            $post['0']['author'],
            $post['0']['short_content'],
            $post['0']['content'],
            (int) $post['0']['id']);
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

    public function getPage(int $size): array
    {
        //Fix that problem
        $sql = 'SELECT TOP ? * FROM post';
        $state = $this->entityManager->getConnection()->prepare($sql);
        $state->bindValue(1, $size);

        $state->execute();
        $posts = $state->fetchAll();

        return $posts;
    }
}