<?php

declare(strict_types=1);

namespace App\App\Comment\Application\Command\UpdateComment;


use App\App\Comment\Application\Command\UpdateCommentCommand;
use App\App\Comment\Domain\Exception\ForbiddenException;
use App\App\Comment\Domain\Repository\CommentStore;
use App\App\Comment\Domain\Validator\CommentContentValidator;
use App\App\Shared\Application\Command\CommandHandlerInterface;
use App\App\Shared\Infrastructure\Peristance\Read\Exception\ResourceNotFoundException;

class UpdateCommentHandler implements CommandHandlerInterface
{
    private CommentStore $commentStore;

    private CommentContentValidator $contentValidator;

    public function __construct(CommentStore $commentStore)
    {
        $this->commentStore = $commentStore;
    }

    public function handle(UpdateCommentCommand $command)
    {
        $comment = $this->commentStore->get($command->getCommentId());

        if ($comment === null) {
            throw new ResourceNotFoundException();
        }
        if ($comment->getAuthor() !== $command->getUser()) {
            throw new ForbiddenException();
        }
        if ($this->contentValidator->isValid($command->getContent()) === true) {
            $comment->updateContent($command->getContent());
            $this->commentStore->store($comment);
        }
    }
}