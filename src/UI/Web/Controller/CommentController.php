<?php

declare(strict_types=1);

namespace App\UI\Web\Controller;


use App\App\Comment\Application\Command\CreateComment\CreateCommentCommand;
use App\UI\Web\Response\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comments')]
class CommentController extends AbstractController
{

    #[Route('/comments', name: 'create_comment', methods: ['POST'])]
    public function createAction(Request $request): ApiResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreateCommentCommand(
            (int) $data['postId'],
            (string) $data['author'],
            (string) $data['content']
        );

    }
}