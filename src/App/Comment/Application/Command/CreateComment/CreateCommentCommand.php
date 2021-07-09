<?php

declare(strict_types=1);

namespace App\App\Comment\Application\Command\CreateComment;


use App\App\Shared\Application\Command\CommandInterface;

final class CreateCommentCommand implements CommandInterface
{
    private int $postId;

    private string $author;

    private string $content;

    public function __construct(int $postId, string $author, string $content)
    {
        $this->postId = $postId;
        $this->author = $author;
        $this->content = $content;
    }


    public function getPostId(): int
    {
        return $this->postId;
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