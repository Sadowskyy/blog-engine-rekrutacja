<?php

declare(strict_types=1);

namespace App\App\Post\Domain\Repository;


interface PostRepositoryInterface
{
    public function get(int $postId): Post;

    public function store(Post $post): void;
}