<?php

declare(strict_types=1);

namespace App\App\Comment\Application\Query\FindByCommentId;


use App\App\Comment\Domain\Repository\CommentStore;
use App\App\Shared\Application\Query\QueryHandlerInterface;
use App\App\Shared\Domain\Comment;
use App\App\Shared\Domain\Post;

class FindByCommentIdHandler implements QueryHandlerInterface
{
    private CommentStore $commentStore;

    public function __construct(CommentStore $commentStore)
    {
        $this->commentStore = $commentStore;
    }

    public function handle(FindByCommentIdQuery $query): Comment
    {
        return $this->commentStore->get($query->commentId);
    }
}