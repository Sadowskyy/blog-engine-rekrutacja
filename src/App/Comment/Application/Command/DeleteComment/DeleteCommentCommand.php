<?php

declare(strict_types=1);

namespace App\App\Comment\Application\DeleteComment;


use App\App\Shared\Application\Command\CommandInterface;

final class DeleteCommentCommand implements CommandInterface
{
    private int $commentId;

    private string $user;

    public function __construct(int $commentId, string $user)
    {
        $this->commentId = $commentId;
        $this->user = $user;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}