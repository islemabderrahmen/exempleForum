<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtudiantRepository")
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Date de Naissance ne doit pas être vide.")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=5)
     * @Assert\NotBlank(message="Sexe ne doit pas être vide.")
     */
    private $sexe;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="Téléhone de doit pas être vide.")
     * @Assert\Length(
     *     min="5",
     *     max="20",
     *     minMessage="Téléphone doit avoir au minimum ({{ limit }}) caractères.",
     *     maxMessage="Téléphone activité doit avoir au maximum ({{ limit }}) caractères."
     * )
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Pays ne doit pas être vide.")
     */
    private $pays;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Avatar", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $avatar;

    /**
     * @ORM\OneToOne(targetEntity="Utilisateur", inversedBy="etudiant", cascade={"all"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getAvatar(): ?Avatar
    {
        return $this->avatar;
    }

    public function setAvatar(?Avatar $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }


}
