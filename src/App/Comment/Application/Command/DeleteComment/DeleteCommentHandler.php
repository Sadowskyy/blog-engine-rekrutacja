<?php

declare(strict_types=1);

namespace App\App\Comment\Application\Command\DeleteComment;

use App\App\Comment\Domain\Exception\ForbiddenException;
use App\App\Comment\Domain\Repository\CommentStore;
use App\App\Post\Domain\Repository\PostStore;
use App\App\Shared\Application\Command\CommandHandlerInterface;
use App\App\Shared\Infrastructure\Peristance\Read\Exception\ResourceNotFoundException;

class DeleteCommentHandler implements CommandHandlerInterface
{
    private CommentStore $commentStore;

    protected PostStore $postStore;

    public function __construct(CommentStore $commentStore, PostStore $postStore)
    {
        $this->commentStore = $commentStore;
        $this->postStore = $postStore;
    }

    public function handle(DeleteCommentCommand $command)
    {
        $comment = $this->commentStore->get($command->getCommentId());

        if ($comment === null) {
            throw new ResourceNotFoundException();
        }
        if ($comment->getAuthor() !== $command->getUser()) {
            throw new ForbiddenException();
        }

        $this->commentStore->remove($comment);
    }
}