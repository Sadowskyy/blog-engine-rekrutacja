<?php

declare(strict_types=1);

namespace App\App\Comment\Application\Command;


use App\App\Shared\Application\Command\CommandInterface;

final class UpdateCommentCommand implements CommandInterface
{
    private int $postId;

    private int $commentId;

    private string $author;

    private string $content;

    public function __construct(int $postId, int $commentId, string $author, string $content)
    {
        $this->postId = $postId;
        $this->commentId = $commentId;
        $this->author = $author;
        $this->content = $content;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

}