<?php

declare(strict_types=1);

namespace App\UI\Web\Controller;


use App\App\Comment\Application\Command\CreateComment\CreateCommentCommand;
use App\App\Comment\Application\Command\DeleteComment\DeleteCommentCommand;
use App\App\Comment\Application\Command\UpdateComment\UpdateCommentCommand;
use App\App\Comment\Application\Query\FindByCommentId\FindByCommentIdQuery;
use App\App\Comment\Application\Query\FindByPostId\FindCommentsByPostIdQuery;

use App\App\Shared\Infrastructure\Web\CqrsController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comments')]
class CommentController extends CqrsController
{


    #[Route(name: 'create_comment', methods: ['POST'])]
    public function createAction(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreateCommentCommand(
            (int)$data['postId'],
            (string)$data['author'],
            (string)$data['content']
        );

        $this->handle($command);

        return $this->json($command);
    }

    #[Route(name: 'delete_comment', methods: ['DELETE'])]
    public function deleteAction(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new DeleteCommentCommand(
            (int)$data['commentId'],
            (string)$data['user'],
        );

        $this->handle($command);

        return $this->json($command);
    }

    #[Route(name: 'update_comment', methods: ['PATCH'])]
    public function updateAction(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new UpdateCommentCommand(
            (int)$data['commentId'],
            (string)$data['user'],
            (string)$data['content']
        );

        $this->handle($command);

        return $this->json($command);
    }

    #[Route('/{commentId}', name: 'find_comment_by_comment_id', methods: ['GET'])]
    public function findCommentByCommentId(int $commentId): Response
    {
        $command = new FindByCommentIdQuery($commentId);

        $comment = $this->ask($command);

        return $this->json($comment);
    }

    #[Route('/posts/{postId}', name: 'get_all_comments_by_post_id', methods: ['GET'])]
    public function findAllCommentsInPost(int $postId): Response
    {
        $command = new FindCommentsByPostIdQuery($postId);

        $post = $this->ask($command);

        return $this->json($post['0'][]);
    }
}