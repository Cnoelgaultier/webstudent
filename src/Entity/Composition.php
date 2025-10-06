<?php

namespace App\Entity;

use App\Repository\CompositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompositionRepository::class)]
class Composition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Baguette>
     */
    #[ORM\ManyToMany(targetEntity: Baguette::class, inversedBy: 'compositions')]
    private Collection $baguette;

    public function __construct()
    {
        $this->baguette = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Baguette>
     */
    public function getBaguette(): Collection
    {
        return $this->baguette;
    }

    public function addBaguette(Baguette $baguette): static
    {
        if (!$this->baguette->contains($baguette)) {
            $this->baguette->add($baguette);
        }

        return $this;
    }

    public function removeBaguette(Baguette $baguette): static
    {
        $this->baguette->removeElement($baguette);

        return $this;
    }
}
