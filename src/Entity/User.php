<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[Vich\Uploadable]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlAvatar = null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    /**
     * @var Collection<int, Favori>
     */
    #[ORM\OneToMany(targetEntity: Favori::class, mappedBy: 'users')]
    private Collection $favori;

    /**
     * @var Collection<int, Document>
     */
    #[ORM\OneToMany(targetEntity: Document::class, mappedBy: 'users')]
    private Collection $document;

    /**
     * @var Collection<int, Search>
     */
    #[ORM\OneToMany(targetEntity: Search::class, mappedBy: 'users')]
    private Collection $search;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'users')]
    private Collection $comment;

    /**
     * @var Collection<int, Download>
     */
    #[ORM\OneToMany(targetEntity: Download::class, mappedBy: 'users')]
    private Collection $download;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    public function __construct()
    {
        $this->favori = new ArrayCollection();
        $this->document = new ArrayCollection();
        $this->search = new ArrayCollection();
        $this->comment = new ArrayCollection();
        $this->download = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): static
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUrlAvatar(): ?string
    {
        return $this->urlAvatar;
    }

    public function setUrlAvatar(?string $urlAvatar): static
    {
        $this->urlAvatar = $urlAvatar;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Favori>
     */
    public function getFavori(): Collection
    {
        return $this->favori;
    }

    public function addFavori(Favori $favori): static
    {
        if (!$this->favori->contains($favori)) {
            $this->favori->add($favori);
            $favori->setUsers($this);
        }

        return $this;
    }

    public function removeFavori(Favori $favori): static
    {
        if ($this->favori->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getUsers() === $this) {
                $favori->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocument(): Collection
    {
        return $this->document;
    }

    public function addDocument(Document $document): static
    {
        if (!$this->document->contains($document)) {
            $this->document->add($document);
            $document->setUsers($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): static
    {
        if ($this->document->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getUsers() === $this) {
                $document->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Search>
     */
    public function getSearch(): Collection
    {
        return $this->search;
    }

    public function addSearch(Search $search): static
    {
        if (!$this->search->contains($search)) {
            $this->search->add($search);
            $search->setUsers($this);
        }

        return $this;
    }

    public function removeSearch(Search $search): static
    {
        if ($this->search->removeElement($search)) {
            // set the owning side to null (unless already changed)
            if ($search->getUsers() === $this) {
                $search->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comment->contains($comment)) {
            $this->comment->add($comment);
            $comment->setUsers($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUsers() === $this) {
                $comment->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Download>
     */
    public function getDownload(): Collection
    {
        return $this->download;
    }

    public function addDownload(Download $download): static
    {
        if (!$this->download->contains($download)) {
            $this->download->add($download);
            $download->setUsers($this);
        }

        return $this;
    }

    public function removeDownload(Download $download): static
    {
        if ($this->download->removeElement($download)) {
            // set the owning side to null (unless already changed)
            if ($download->getUsers() === $this) {
                $download->setUsers(null);
            }
        }

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFullName()
    {
        return $this->getFirstName().' '.$this->getLastName();
    }
    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'avatar', fileNameProperty: 'imageNameAvatar', size: 'imageSizeAvatar')]
    private ?File $imageFileAvatar = null;

    #[ORM\Column(nullable: true)]
    private ?string $imageNameAvatar = null;

    #[ORM\Column(nullable: true)]
    private ?int $imageSizeAvatar = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedImageAvatarAt = null;

    public function setImageFileAvatar(?File $imageFileAvatar = null): void
    {
        $this->imageFileAvatar = $imageFileAvatar;

        if (null !== $imageFileAvatar) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedImageAvatarAt = new \DateTimeImmutable();
        }
    }

    public function getImageFileAvatar(): ?File
    {
        return $this->imageFileAvatar;
    }

    public function setImageNameAvatar(?string $imageNameAvatar): void
    {
        $this->imageNameAvatar = $imageNameAvatar;
    }

    public function getImageNameAvatar(): ?string
    {
        return $this->imageNameAvatar;
    }

    public function setImageSizeAvatar(?int $imageSizeAvatar): void
    {
        $this->imageSizeAvatar = $imageSizeAvatar;
    }

    public function getImageSizeAvatar(): ?int
    {
        return $this->imageSizeAvatar;
    }

}