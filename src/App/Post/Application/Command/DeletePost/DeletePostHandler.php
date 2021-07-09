<?php

declare(strict_types=1);

namespace App\App\Post\Application\Command\DeletePost;


use App\App\Post\Domain\Exception\ForbiddenException;
use App\App\Post\Domain\Repository\PostRepositoryInterface;
use App\App\Shared\Application\Command\CommandHandlerInterface;
use App\App\Shared\Infrastructure\Peristance\Read\Exception\ResourceNotFoundException;

class DeletePostHandler implements CommandHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    public function handle(DeletePostCommand $command): void
    {
        $post = $this->postRepository->get($command->getPostId());

        if ($post === null) {
            throw new ResourceNotFoundException();
        }

        if($post->getAuthor() !== $command->getUser()) {
            throw new ForbiddenException();
        }

        $this->postRepository->remove($post);
    }
}