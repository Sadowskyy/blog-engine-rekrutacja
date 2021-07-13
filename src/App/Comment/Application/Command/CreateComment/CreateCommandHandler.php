<?php

declare(strict_types=1);


namespace App\App\Comment\Application\Command\CreateComment;


use App\App\Comment\Domain\Repository\CommentStore;
use App\App\Comment\Domain\Validator\CommentContentValidator;
use App\App\Post\Domain\Repository\PostStore;
use App\App\Shared\Application\Command\CommandHandlerInterface;
use App\App\Shared\Domain\Comment;
use App\App\Shared\Infrastructure\Peristance\Read\Exception\ResourceNotFoundException;

final class CreateCommandHandler implements CommandHandlerInterface
{
    private CommentStore $commentStore;

    private PostStore $postStore;

    private CommentContentValidator $commentValidator;

    public function __construct(CommentStore $commentStore, PostStore $postStore, CommentContentValidator $commentValidator)
    {
        $this->commentStore = $commentStore;
        $this->postStore = $postStore;
        $this->commentValidator = $commentValidator;
    }

    public function handle(CreateCommentCommand $command)
    {
        $post = $this->postStore->get($command->getPostId());

        if ($post === null) {
            throw new ResourceNotFoundException();
        }

        if ($this->commentValidator->isValid($command->getContent()) === true) {
            $comment = Comment::create($command->getContent(), $command->getAuthor(), $post);
            $post->addComment($comment);

            $this->commentStore->store($comment);
            $this->postStore->store($post);
       }
    }
}