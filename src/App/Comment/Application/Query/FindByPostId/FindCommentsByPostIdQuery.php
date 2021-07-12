<?php

declare(strict_types=1);

namespace App\App\Comment\Application\Query\FindByPostId;


use App\App\Shared\Application\Query\QueryInterface;

class FindCommentsByPostIdQuery implements QueryInterface
{
    public int $postId;

    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }
}