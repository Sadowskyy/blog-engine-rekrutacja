<?php


namespace App\App\Comment\Domain;


use App\App\Post\Domain\Post;

class Comment
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
     * @ORM\Column(type="string", length=200)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
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

    public function commentPost(Post $post)
    {
        if ($this->commentedPost === null) {
            $this->commentedPost = $post;
        }
    }
}