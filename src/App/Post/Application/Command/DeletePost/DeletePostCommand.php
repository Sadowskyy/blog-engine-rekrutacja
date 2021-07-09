<?php

declare(strict_types=1);

namespace App\App\Post\Application\Command\DeletePost;


use App\App\Shared\Application\Command\CommandInterface;

final class DeletePostCommand implements CommandInterface
{
    private int $postId;

    private string $user;

    public function __construct(int $postId, string $user)
    {
        $this->postId = $postId;
        $this->user = $user;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}