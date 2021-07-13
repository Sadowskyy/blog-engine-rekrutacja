<?php

declare(strict_types=1);

namespace App\App\Shared\Domain;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public string $author;

    /**
     * @ORM\Column(type="text", length=200)
     */
    public string $content;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    public Post $commentedPost;

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

    public static function createView(string $author, string $content, Post $post)
    {
        return new Comment($author, $content, $post);
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

    public function addCommentedPost(Post $post)
    {
        $this->commentedPost = $post;
    }

    public function updateContent(string $content)
    {
        $this->content = $content;
    }
}