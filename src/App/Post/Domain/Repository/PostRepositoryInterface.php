<?php

declare(strict_types=1);

namespace App\App\Post\Domain\Repository;



use App\App\Shared\Domain\Post;

interface PostRepositoryInterface
{
    public function get(int $postId);

    public function store(Post $post): void;

    public function remove(Post $post): void;
}