<?php

declare(strict_types=1);

namespace App\App\Post\Application\Query\FindByPostId;


use App\App\Shared\Application\Query\QueryInterface;

class FindPostByPostId implements QueryInterface
{
    public int $postId;

    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }
}