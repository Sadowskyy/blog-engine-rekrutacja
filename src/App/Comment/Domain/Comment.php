<?php


namespace App\App\Comment\Domain;


use App\App\Post\Domain\Post;

class Comment
{
    private int $id;

    private string $author;

    private string $content;

    private Post $commentedPost;

    public function __construct(string $author, string $content, Post $commentedPost)
    {
        $this->author = $author;
        $this->content = $content;
        $this->commentedPost = $commentedPost;
    }

    public static function create(string $content, string $author, Post $commentedPost): Comment
    {
        return new Comment($author, $content, $commentedPost);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCommentedPost(): Post
    {
        return $this->commentedPost;
    }
}