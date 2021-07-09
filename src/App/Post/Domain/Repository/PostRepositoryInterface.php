<?php

declare(strict_types=1);

namespace App\App\Post\Domain\Repository;


use App\App\Post\Domain\Post;

interface PostRepositoryInterface
{
    public function get(int $postId): Post;

    public function store(Post $post): void;

    public function remove(Post $post): void;
}