<?php

declare(strict_types=1);

namespace App\App\Post\Application\Command\CreatePost;


use App\App\Shared\Application\Command\CommandInterface;

final class CreatePostCommand implements CommandInterface
{
    private string $content;

    private string $author;

    public function __construct(string $content, string $author)
    {
        $this->content = $content;
        $this->author = $author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
}