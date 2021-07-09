<?php

declare(strict_types=1);


use App\App\Comment\Application\DeleteComment\DeleteCommentCommand;
use App\App\Comment\Domain\Exception\ForbiddenException;
use App\App\Comment\Domain\Repository\CommentStore;
use App\App\Shared\Application\Command\CommandHandlerInterface;
use App\App\Shared\Infrastructure\Peristance\Read\Exception\ResourceNotFoundException;

class DeleteCommentHandler implements CommandHandlerInterface
{
    private CommentStore $commentStore;

    public function __construct(CommentStore $commentStore)
    {
        $this->commentStore = $commentStore;
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