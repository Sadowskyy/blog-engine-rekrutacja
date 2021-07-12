<?php

declare(strict_types=1);

namespace App\App\Shared\Domain;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post
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
     * @ORM\Column(type="string", length=60)
     */
    public string $shortContent;

    /**
     * @ORM\Column(type="text", length=1000)
     */
    public string $content;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="commentedPost")
     * @ORM\JoinColumn(nullable=false)
     */
    public Collection $comments;

    public function __construct(string $author, string $shortContent, string $content)
    {
        $this->author = $author;
        $this->shortContent = $shortContent;
        $this->content = $content;
    }

    public static function create(string $author, string $content): Post
    {
        return new Post($author, substr($content, 0, 59), $content);
    }

    public static function createView(?string $author, ?string $shortContent, ?string $content, ?int $id): Post
    {
        $post = new Post($author, $shortContent, $content);
        $post->setId($id);

        return $post;
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

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): void
    {
        $this->comments->add($comment);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function updateAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function updateShortContent(string $shortContent): void
    {
        $this->shortContent = $shortContent;
    }

    public function setComments(Collection $comments): void
    {
        $this->comments = $comments;
    }

}