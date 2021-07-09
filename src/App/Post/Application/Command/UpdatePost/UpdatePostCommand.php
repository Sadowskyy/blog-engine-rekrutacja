<?php

declare(strict_types=1);

namespace App\App\Post\Application\Command\UpdatePost;


use App\App\Shared\Application\Command\CommandInterface;

class UpdatePostCommand implements CommandInterface
{
    private int $postId;

    private string $user;

    private string $content;

    public function __construct(int $postId, string $user, string $content)
    {
        $this->postId = $postId;
        $this->user = $user;
        $this->content = $content;
    }

    public function getPostId(): int
    {
        return $this->postId;
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