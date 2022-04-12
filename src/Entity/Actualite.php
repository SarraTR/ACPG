<?php

namespace App\Entity;

use App\Repository\ActualiteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
#[ORM\Entity(repositoryClass: ActualiteRepository::class)]
class Actualite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'date')]
    private $dateActu;

    #[ORM\Column(type: 'text', length: 255)]
    private $textActu;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image= 'logoACPG.jpg';

    /**
     * @Vich\UploadableField(mapping="products", fileNameProperty="Image") *
     * @param File|UploadedFile|null $fichierImage
     *
     */
    private mixed $fichierImage = null;
    

    #[ORM\ManyToOne(targetEntity: Licencie::class, inversedBy: 'actualite')]
    private $auteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateActu(): ?\DateTimeInterface
    {
        return $this->dateActu;
    }

    public function setDateActu(\DateTimeInterface $dateActu): self
    {
        $this->dateActu = $dateActu;

        return $this;
    }

    public function getTextActu(): ?string
    {
        return $this->textActu;
    }

    public function setTextActu(string $textActu): self
    {
        $this->textActu = $textActu;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFichierImage(): mixed
    {
        return $this->fichierImage;
    }

    /**
     * @param mixed
     */
    public function setFichierImage(?File $fichier = null): self
    {
        $this->fichierImage = $fichier;

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
