<?php


namespace App\App\Post\Domain;


use App\App\Comment\Domain\Comment;

class Post
{
    private int $id;

    private string $author;

    private string $shortContent;

    private string $content;

    private $comments = [];

    public function __construct(string $author, string $shortContent, string $content)
    {
        $this->author = $author;
        $this->shortContent = $shortContent;
        $this->content = $content;
    }

    public static function create(string $author, string $description)
    {
        return new Post($author, substr($description, 0, 59), $description);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getShortContent(): string
    {
        return $this->shortContent;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getComments(): array
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        array_push($this->comments, $comment);
    }
}