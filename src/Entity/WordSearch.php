<?php

namespace App\Entity;

use App\Repository\WordSearchRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordSearchRepository::class)]
class WordSearch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $wordKey = null;

    /**
     * @var Collection<int, Search>
     */
    #[ORM\ManyToMany(targetEntity: Search::class, mappedBy: 'wordSearchKey')]
    private Collection $searches;

    public function __construct()
    {
        $this->searches = new ArrayCollection();
    }


    public function __toString(): string
    {
        return $this->wordKey;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWordKey(): ?string
    {
        return $this->wordKey;
    }

    public function setWordKey(string $wordKey): static
    {
        $this->wordKey = $wordKey;

        return $this;
    }

    /**
     * @return Collection<int, Search>
     */
    public function getSearches(): Collection
    {
        return $this->searches;
    }

    public function addSearch(Search $search): static
    {
        if (!$this->searches->contains($search)) {
            $this->searches->add($search);
            $search->addWordSearchKey($this);
        }

        return $this;
    }

    public function removeSearch(Search $search): static
    {
        if ($this->searches->removeElement($search)) {
            $search->removeWordSearchKey($this);
        }

        return $this;
    }
}
