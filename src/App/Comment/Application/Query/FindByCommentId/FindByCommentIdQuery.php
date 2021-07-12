<?php

declare(strict_types=1);

namespace App\App\Comment\Application\Query\FindByCommentId;


use App\App\Shared\Application\Query\QueryInterface;

class FindByCommentIdQuery implements QueryInterface
{
    public int $commentId;

    public function __construct(int $commentId)
    {
        $this->commentId = $commentId;
    }
}