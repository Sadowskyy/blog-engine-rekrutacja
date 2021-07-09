<?php

declare(strict_types=1);


namespace App\App\Comment\Domain\Repository;


interface CommentRepositoryInterface
{
    public function get(int $commentId): Comment;

    public function store(Comment $comment): void;
}