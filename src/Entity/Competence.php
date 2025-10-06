<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $code = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Eleve>
     */
    #[ORM\ManyToMany(targetEntity: Eleve::class, mappedBy: 'competence')]
    private Collection $eleves;

    /**
     * @var Collection<int, Matiere>
     */
    #[ORM\ManyToMany(targetEntity: Matiere::class, mappedBy: 'competence')]
    private Collection $matieres;

    /**
     * @var Collection<int, Professeur>
     */
    #[ORM\ManyToMany(targetEntity: Professeur::class, inversedBy: 'competences')]
    private Collection $professeur;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->matieres = new ArrayCollection();
        $this->professeur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): static
    {
        $this->code = $code;

        return $this;
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
            $elefe->addCompetence($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): static
    {
        if ($this->eleves->removeElement($elefe)) {
            $elefe->removeCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Matiere>
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): static
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres->add($matiere);
            $matiere->addCompetence($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): static
    {
        if ($this->matieres->removeElement($matiere)) {
            $matiere->removeCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseur(): Collection
    {
        return $this->professeur;
    }

    public function addProfesseur(Professeur $professeur): static
    {
        if (!$this->professeur->contains($professeur)) {
            $this->professeur->add($professeur);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): static
    {
        $this->professeur->removeElement($professeur);

        return $this;
    }
}
