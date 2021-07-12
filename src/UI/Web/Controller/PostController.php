<?php

declare(strict_types=1);

namespace App\UI\Web\Controller;


use App\App\Post\Application\Command\CreatePost\CreatePostCommand;
use App\App\Post\Application\Command\DeletePost\DeletePostCommand;
use App\App\Post\Application\Command\UpdatePost\UpdatePostCommand;
use App\App\Post\Application\Query\FindByPostId\FindPostByPostId;
use App\App\Post\Application\Query\FindSpecifiedNumberOfPosts\FindPostsBySpecifiedNumberQuery;
use App\App\Post\Infrastructure\Web\CqrsController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/posts')]
class PostController extends CqrsController
{

    #[Route(name: 'create_post', methods: ['POST'])]
    public function createAction(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreatePostCommand(
            (string)$data['content'],
            (string)$data['author'],
        );

        $this->handle($command);

        return $this->json($command);
    }

    #[Route(name: 'delete_post', methods: ['DELETE'])]
    public function deleteAction(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new DeletePostCommand(
            (int)$data['postId'],
            (string)$data['user']
        );

        $this->handle($command);

        return $this->json($command);
    }

    #[Route(name: 'update_post', methods: ['PATCH'])]
    public function updateAction(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $command = new UpdatePostCommand(
            (int)$data['postId'],
            (string)$data['user'],
            (string)$data['content']
        );

        $this->handle($command);

        return $this->json($command);
    }

    #[Route('/{id}', name: 'find_post_by_id', methods: ['GET'])]
    public function findPostById(int $id): Response
    {
        $command = new FindPostByPostId($id);

        $post = $this->ask($command);

        return $this->json($post);
    }

    #[Route('', name: 'find_posts_by_quantity', methods: ['GET'])]
    public function findPostsByQuantity(Request $request): Response
    {
        $quantity = (int)$request->query->get('size');
        $command = new FindPostsBySpecifiedNumberQuery($quantity);

        $posts = $this->ask($command);

        return $this->json(
            array(
                'size' => $quantity,
                'data' => $posts
            )
        );
    }
}