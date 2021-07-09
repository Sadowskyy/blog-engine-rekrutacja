<?php


namespace App\App\Post\Domain;


use App\App\Comment\Domain\Comment;

class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $shortContent;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="commentedPost")
     */
    private array $comments = [];

    public function __construct(string $author, string $shortContent, string $content)
    {
        $this->author = $author;
        $this->shortContent = $shortContent;
        $this->content = $content;
    }

    public static function create(string $author, string $content)
    {
        return new Post($author, substr($content, 0, 59), $description);
    }

    public function updateContent(string $content)
    {
        $this->content = $content;
        $this->shortContent = substr($content, 0, 59);
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