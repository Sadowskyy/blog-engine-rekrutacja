<?php

declare(strict_types=1);

namespace App\App\Comment\Application\Command\UpdateComment;


use App\App\Shared\Application\Command\CommandInterface;

final class UpdateCommentCommand implements CommandInterface
{
    private int $commentId;

    private string $user;

    private string $content;

    public function __construct(int $commentId, string $user, string $content)
    {
        $this->commentId = $commentId;
        $this->user = $user;
        $this->content = $content;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function getUser(): string
    {
        return $this->user;
    }


    public function getContent(): string
    {
        return $this->content;
    }
}