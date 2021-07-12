<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Bus\Command;


use App\App\Comment\Application\Command\CreateComment\CreateCommandHandler;
use App\App\Comment\Application\Command\CreateComment\CreateCommentCommand;
use App\App\Comment\Application\Command\DeleteComment\DeleteCommentCommand;
use App\App\Comment\Application\Command\DeleteComment\DeleteCommentHandler;
use App\App\Comment\Application\Command\UpdateComment\UpdateCommentHandler;
use App\App\Comment\Application\Command\UpdateCommentCommand;
use App\App\Post\Application\Command\CreatePost\CreatePostCommand;
use App\App\Post\Application\Command\CreatePost\CreatePostHandler;
use App\App\Post\Application\Command\DeletePost\DeletePostCommand;
use App\App\Post\Application\Command\DeletePost\DeletePostHandler;
use App\App\Post\Application\Command\UpdatePost\UpdatePostCommand;
use App\App\Post\Application\Command\UpdatePost\UpdatePostHandler;
use App\App\Shared\Application\Command\CommandBusInterface;
use App\App\Shared\Application\Command\CommandInterface;

//TODO poprawic jak bedzie czas.
class SimpleCommandBus implements CommandBusInterface
{
    private CreateCommandHandler $createCommentHandler;

    private UpdateCommentHandler $updateCommentHandler;

    private DeleteCommentHandler $deleteCommentHandler;

    private CreatePostHandler $createPostHandler;

    private UpdatePostHandler $updatePostHandler;

    private DeletePostHandler $deletePostHandler;

    public function __construct(CreateCommandHandler $createCommentHandler, UpdateCommentHandler $updateCommentHandler, DeleteCommentHandler $deleteCommentHandler, CreatePostHandler $createPostHandler, UpdatePostHandler $updatePostHandler, DeletePostHandler $deletePostHandler)
    {
        $this->createCommentHandler = $createCommentHandler;
        $this->updateCommentHandler = $updateCommentHandler;
        $this->deleteCommentHandler = $deleteCommentHandler;
        $this->createPostHandler = $createPostHandler;
        $this->updatePostHandler = $updatePostHandler;
        $this->deletePostHandler = $deletePostHandler;
    }

    public function handle(CommandInterface $command)
    {
        if ($command instanceof CreateCommentCommand) {
            $this->createCommentHandler->handle($command);
        }
        if ($command instanceof UpdateCommentCommand) {
            $this->updateCommentHandler->handle($command);
        }
        if ($command instanceof DeleteCommentCommand) {
            $this->deleteCommentHandler->handle($command);
        }
        if ($command instanceof CreatePostCommand) {
            $this->createPostHandler->handle($command);
        }
        if ($command instanceof UpdatePostCommand) {
            $this->updatePostHandler->handle($command);
        }
        if ($command instanceof DeletePostCommand) {
            $this->deletePostHandler->handle($command);
        }
    }
}