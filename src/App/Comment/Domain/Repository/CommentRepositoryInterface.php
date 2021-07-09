<?php

declare(strict_types=1);


namespace App\App\Comment\Domain\Repository;


use App\App\Comment\Domain\Comment;

interface CommentRepositoryInterface
{
    public function get(int $commentId): Comment;

    public function store(Comment $comment): void;

    public function remove(Comment $comment): void;
}