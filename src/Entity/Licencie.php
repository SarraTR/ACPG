<?php

namespace App\Entity;

use App\Repository\LicencieRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: LicencieRepository::class)]
#[UniqueEntity(fields: ['numeroDeLicence'], message: 'There is already an account with this numeroDeLicence')]
class Licencie implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $numeroDeLicence;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;

    #[ORM\Column(type: 'date')]
    private $dateNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    private $paysNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    private $villeNaissance;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'integer')]
    private $codePostal;

    #[ORM\Column(type: 'string', length: 255)]
    private $ville;

    #[ORM\Column(type: 'string', length: 255)]
    private $mail1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $mail2;

    #[ORM\Column(type: 'integer')]
    private $telephone1;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $telephone2;

    #[ORM\ManyToOne(targetEntity: Groupe::class, inversedBy: 'patineurs')]
    private $niveau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroDeLicence(): ?string
    {
        return $this->numeroDeLicence;
    }

    public function setNumeroDeLicence(string $numeroDeLicence): self
    {
        $this->numeroDeLicence = $numeroDeLicence;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->numeroDeLicence;
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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getPaysNaissance(): ?string
    {
        return $this->paysNaissance;
    }

    public function setPaysNaissance(string $paysNaissance): self
    {
        $this->paysNaissance = $paysNaissance;

        return $this;
    }

    public function getVilleNaissance(): ?string
    {
        return $this->villeNaissance;
    }

    public function setVilleNaissance(string $villeNaissance): self
    {
        $this->villeNaissance = $villeNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

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

    public function getMail1(): ?string
    {
        return $this->mail1;
    }

    public function setMail1(string $mail1): self
    {
        $this->mail1 = $mail1;

        return $this;
    }

    public function getMail2(): ?string
    {
        return $this->mail2;
    }

    public function setMail2(?string $mail2): self
    {
        $this->mail2 = $mail2;

        return $this;
    }

    public function getTelephone1(): ?int
    {
        return $this->telephone1;
    }

    public function setTelephone1(int $telephone1): self
    {
        $this->telephone1 = $telephone1;

        return $this;
    }

    public function getTelephone2(): ?int
    {
        return $this->telephone2;
    }

    public function setTelephone2(?int $telephone2): self
    {
        $this->telephone2 = $telephone2;

        return $this;
    }


    public function getNiveau(): ?groupe
    {
        return $this->niveau;
    }

    public function setNiveau(?groupe $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
}
