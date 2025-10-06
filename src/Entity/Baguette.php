<?php

namespace App\Entity;

use App\Repository\BaguetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BaguetteRepository::class)]
class Baguette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $taille = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\OneToMany(targetEntity: Eleve::class, mappedBy: 'baguette')]
    private Collection $eleves;

    /**
     * @var Collection<int, Composition>
     */
    #[ORM\ManyToMany(targetEntity: Composition::class, mappedBy: 'baguette')]
    private Collection $compositions;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->compositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTaille(): ?float
    {
        return $this->taille;
    }

    public function setTaille(float $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): static
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves->add($elefe);
            $elefe->setBaguette($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getBaguette() === $this) {
                $elefe->setBaguette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Composition>
     */
    public function getCompositions(): Collection
    {
        return $this->compositions;
    }

    public function addComposition(Composition $composition): static
    {
        if (!$this->compositions->contains($composition)) {
            $this->compositions->add($composition);
            $composition->addBaguette($this);
        }

        return $this;
    }

    public function removeComposition(Composition $composition): static
    {
        if ($this->compositions->removeElement($composition)) {
            $composition->removeBaguette($this);
        }

        return $this;
    }
}
