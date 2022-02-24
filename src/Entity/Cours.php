<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'time')]
    private $heureDebut;

    #[ORM\Column(type: 'integer')]
    private $duréeMinutes;

    #[ORM\ManyToMany(targetEntity: Groupe::class, inversedBy: 'cours')]
    private $groupe;

    #[ORM\ManyToOne(targetEntity: Licencie::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $auteur;

    public function __construct()
    {
        $this->groupe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getDuréeMinutes(): ?int
    {
        return $this->duréeMinutes;
    }

    public function setDuréeMinutes(int $duréeMinutes): self
    {
        $this->duréeMinutes = $duréeMinutes;

        return $this;
    }

    /**
     * @return Collection<int, Groupe>
     */
    public function getGroupe(): Collection
    {
        return $this->groupe;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupe->contains($groupe)) {
            $this->groupe[] = $groupe;
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        $this->groupe->removeElement($groupe);

        return $this;
    }

    public function getAuteur(): ?Licencie
    {
        return $this->auteur;
    }

    public function setAuteur(?Licencie $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}
