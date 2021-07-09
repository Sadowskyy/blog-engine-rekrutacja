<?php

declare(strict_types=1);

namespace App\App\Post\Application\Command\UpdatePost;


use App\App\Post\Domain\Exception\ForbiddenException;
use App\App\Post\Domain\Repository\PostRepositoryInterface;
use App\App\Post\Domain\Validator\ContentValidator;
use App\App\Shared\Application\Command\CommandHandlerInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class UpdatePostHandler implements CommandHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    private ContentValidator $postContentValidator;

    public function handle(UpdatePostCommand $command): void
    {
        $post = $this->postRepository->get($command->getPostId());

        if ($post === null) {
            throw new ResourceNotFoundException();
        }
        if($post->getAuthor() !== $command->getUser()) {
            throw new ForbiddenException();
        }

        if ($this->postContentValidator->isValid($command->getContent()) === true) {
            $post->updateContent($command->getContent());
            $this->postRepository->store($post);
        }
    }
}