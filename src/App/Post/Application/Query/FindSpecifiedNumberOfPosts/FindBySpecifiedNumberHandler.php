<?php

declare(strict_types=1);

namespace App\App\Post\Application\Query\FindSpecifiedNumberOfPosts;


use App\App\Post\Domain\Repository\PostStore;
use App\App\Post\Infrastructure\ReadModel\PostView;
use App\App\Shared\Application\Query\QueryHandlerInterface;

class FindBySpecifiedNumberHandler implements QueryHandlerInterface
{
    private PostStore $postStore;

    public function __construct(PostStore $postStore)
    {
        $this->postStore = $postStore;
    }

    public function handle(FindPostsBySpecifiedNumberQuery $query): array
    {
        return $this->postStore->getPage($query->size);
    }
}