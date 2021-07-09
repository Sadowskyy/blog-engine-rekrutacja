<?php

declare(strict_types=1);

namespace App\UI\Web\Controller;


use App\App\Post\Application\Command\CreatePost\CreatePostCommand;
use App\UI\Web\Response\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/posts')]
class PostController extends AbstractController
{


    #[Route('/comments', name: 'create_comment', methods: ['POST'])]
    public function createAction(Request $request): ApiResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreatePostCommand(
            (string) $data['content'],
            (string) $data['shortContent'],
            (string) $data['author'],
        );
    }
}