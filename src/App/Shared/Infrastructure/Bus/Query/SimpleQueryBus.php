<?php

declare(strict_types=1);

namespace App\App\Shared\Infrastructure\Bus\Query;


use App\App\Comment\Application\Query\FindByCommentId\FindByCommentIdHandler;
use App\App\Comment\Application\Query\FindByCommentId\FindByCommentIdQuery;
use App\App\Comment\Application\Query\FindByPostId\FindCommentsByPostIdHandler;
use App\App\Comment\Application\Query\FindByPostId\FindCommentsByPostIdQuery;
use App\App\Post\Application\Query\FindByPostId\FindPostByPostId;
use App\App\Post\Application\Query\FindByPostId\FindPostByPostIdHandler;
use App\App\Post\Application\Query\FindSpecifiedNumberOfPosts\FindBySpecifiedNumberHandler;
use App\App\Post\Application\Query\FindSpecifiedNumberOfPosts\FindPostsBySpecifiedNumberQuery;
use App\App\Shared\Application\Query\QueryBusInterface;
use App\App\Shared\Application\Query\QueryInterface;

//TODO naprawić jak starczy czasu
class SimpleQueryBus implements QueryBusInterface
{
    private FindCommentsByPostIdHandler $findCommentsByPostIdHandler;

    private FindByCommentIdHandler $findByCommentIdHandler;

    private FindPostByPostIdHandler $findPostByPostIdHandler;

    private FindBySpecifiedNumberHandler $findBySpecifiedNumberHandler;

    public function __construct(FindCommentsByPostIdHandler $findCommentsByPostIdHandler, FindByCommentIdHandler $findByCommentIdHandler, FindPostByPostIdHandler $findPostByPostIdHandler, FindBySpecifiedNumberHandler $findBySpecifiedNumberHandler)
    {
        $this->findCommentsByPostIdHandler = $findCommentsByPostIdHandler;
        $this->findByCommentIdHandler = $findByCommentIdHandler;
        $this->findPostByPostIdHandler = $findPostByPostIdHandler;
        $this->findBySpecifiedNumberHandler = $findBySpecifiedNumberHandler;
    }

    public function ask(QueryInterface $query): mixed
    {
        if ($query instanceof FindCommentsByPostIdQuery) {
            return $this->findCommentsByPostIdHandler->handle($query);
        }
        if ($query instanceof FindByCommentIdQuery) {
            return $this->findByCommentIdHandler->handle($query);
        }
        if ($query instanceof FindPostByPostId) {
            return $this->findPostByPostIdHandler->handle($query);
        }
        if ($query instanceof FindPostsBySpecifiedNumberQuery) {
            return $this->findBySpecifiedNumberHandler->handle($query);
        }

        return null;
    }
}