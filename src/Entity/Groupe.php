<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $niveau;

    #[ORM\OneToMany(mappedBy: 'niveau', targetEntity: Licencie::class)]
    private $patineurs;

    #[ORM\ManyToMany(targetEntity: Cours::class, mappedBy: 'groupe')]
    private $cours;

    public function __construct()
    {
        $this->patineurs = new ArrayCollection();
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection<int, Licencie>
     */
    public function getPatineurs(): Collection
    {
        return $this->patineurs;
    }

    public function addPatineur(Licencie $patineur): self
    {
        if (!$this->patineurs->contains($patineur)) {
            $this->patineurs[] = $patineur;
            $patineur->setNiveau($this);
        }

        return $this;
    }

    public function removePatineur(Licencie $patineur): self
    {
        if ($this->patineurs->removeElement($patineur)) {
            // set the owning side to null (unless already changed)
            if ($patineur->getNiveau() === $this) {
                $patineur->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->addGroupe($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            $cour->removeGroupe($this);
        }

        return $this;
    }
}
