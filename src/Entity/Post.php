<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $post;

    /**
     * @ORM\Column(type="date")
     */
    private $datePost;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="post")
     */
    private $userPost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function getDatePost(): ?\DateTimeInterface
    {
        return $this->datePost;
    }

    public function setDatePost(\DateTimeInterface $datePost): self
    {
        $this->datePost = $datePost;

        return $this;
    }

    public function getUserPost(): ?User
    {
        return $this->userPost;
    }

    public function setUserPost(?User $userPost): self
    {
        $this->userPost = $userPost;

        return $this;
    }
}
