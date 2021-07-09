<?php

declare(strict_types=1);

namespace App\App\Post\Application\Command\CreatePost;


use App\App\Post\Domain\Post;
use App\App\Post\Domain\Repository\PostRepositoryInterface;
use App\App\Post\Domain\Validator\ContentValidator;
use App\App\Shared\Application\Command\CommandHandlerInterface;

final class CreatePostHandler implements CommandHandlerInterface
{
    private PostRepositoryInterface $postRepository;

    private ContentValidator $contentValidator;

    public function __construct(PostRepositoryInterface $postRepository, ContentValidator $contentValidator)
    {
        $this->postRepository = $postRepository;
        $this->contentValidator = $contentValidator;
    }

    public function handle(CreatePostCommand $command): void
    {
        if ($this->contentValidator->isValid($command->getContent()) === true) {
            $post = Post::create($command->getAuthor(), $command->getContent());
            $this->postRepository->store($post);
        }
    }
}