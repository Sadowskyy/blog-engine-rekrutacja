<?php

declare(strict_types=1);

namespace App\App\Post\Application\Query\FindSpecifiedNumberOfPosts;


use App\App\Shared\Application\Query\QueryInterface;

class FindPostsBySpecifiedNumberQuery implements QueryInterface
{
    public int $size;

    public function __construct(int $size)
    {
        $this->size = $size;
    }
}