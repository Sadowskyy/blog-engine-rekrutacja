<?php


namespace App\App\Comment\Application\Query\FindByPostId;


use App\App\Post\Domain\Repository\PostStore;
use App\App\Shared\Application\Query\QueryHandlerInterface;
use Doctrine\Common\Collections\Collection;

class FindCommentsByPostIdHandler implements QueryHandlerInterface
{
    private PostStore $postStore;

    public function __construct(PostStore $postStore)
    {
        $this->postStore = $postStore;
    }

    public function handle(FindCommentsByPostIdQuery $query): Collection
    {
        $post = $this->postStore->get($query->postId);

        return $post->getComments();
    }
}