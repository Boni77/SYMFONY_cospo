<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoProfil;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $biographie;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="userCommentaire")
     */
    private $commentaires;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, inversedBy="users")
     */
    private $participer;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="userCreation")
     */
    private $creation;

    /**
     * @ORM\ManyToMany(targetEntity=Sport::class, inversedBy="users")
     */
    private $sport;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="userPost")
     */
    private $post;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\ManyToMany(targetEntity=Sport::class, inversedBy="users")
     */
    private $PracticeSport;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->participer = new ArrayCollection();
        $this->creation = new ArrayCollection();
        $this->sport = new ArrayCollection();
        $this->post = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getPhotoProfil(): ?string
    {
        return $this->photoProfil;
    }

    public function setPhotoProfil(?string $photoProfil): self
    {
        $this->photoProfil = $photoProfil;

        return $this;
    }

    public function getPhotos(): ?string
    {
        return $this->photos;
    }

    public function setPhotos(?string $photos): self
    {
        $this->photos = $photos;

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(string $biographie): self
    {
        $this->biographie = $biographie;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUserCommentaire($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getUserCommentaire() === $this) {
                $commentaire->setUserCommentaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getParticiper(): Collection
    {
        return $this->participer;
    }

    public function addParticiper(Event $participer): self
    {
        if (!$this->participer->contains($participer)) {
            $this->participer[] = $participer;
        }

        return $this;
    }

    public function removeParticiper(Event $participer): self
    {
        $this->participer->removeElement($participer);

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getCreation(): Collection
    {
        return $this->creation;
    }

    public function addCreation(Event $creation): self
    {
        if (!$this->creation->contains($creation)) {
            $this->creation[] = $creation;
            $creation->setUserCreation($this);
        }

        return $this;
    }

    public function removeCreation(Event $creation): self
    {
        if ($this->creation->removeElement($creation)) {
            // set the owning side to null (unless already changed)
            if ($creation->getUserCreation() === $this) {
                $creation->setUserCreation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Sport>
     */
    public function getSport(): Collection
    {
        return $this->sport;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sport->contains($sport)) {
            $this->sport[] = $sport;
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        $this->sport->removeElement($sport);

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPost(): Collection
    {
        return $this->post;
    }

    public function addPost(Post $post): self
    {
        if (!$this->post->contains($post)) {
            $this->post[] = $post;
            $post->setUserPost($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->post->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUserPost() === $this) {
                $post->setUserPost(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }
}
