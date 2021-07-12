<?php

declare(strict_types=1);

namespace App\App\Post\Application\Query\FindByPostId;


use App\App\Post\Domain\Repository\PostStore;
use App\App\Shared\Application\Query\QueryHandlerInterface;
use App\App\Shared\Domain\Post;

class FindPostByPostIdHandler implements QueryHandlerInterface
{
    private PostStore $postStore;

    public function __construct(PostStore $postStore)
    {
        $this->postStore = $postStore;
    }

    public function handle(FindPostByPostId $query): Post
    {
        return $this->postStore->get($query->postId);
    }
}