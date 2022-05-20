<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMessage;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentaires")
     */
    private $userCommentaire;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="commentaire")
     */
    private $event;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDateMessage(): ?\DateTimeInterface
    {
        return $this->dateMessage;
    }

    public function setDateMessage(\DateTimeInterface $dateMessage): self
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    public function getUserCommentaire(): ?User
    {
        return $this->userCommentaire;
    }

    public function setUserCommentaire(?User $userCommentaire): self
    {
        $this->userCommentaire = $userCommentaire;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
}
