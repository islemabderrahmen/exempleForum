<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormateurRepository")
 */
class Formateur
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
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Déscription de doit pas être vide.")
     */
    private $description;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(message="Facebook n'est pas une URL valide")
     */
    private $facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(message="Google+ n'est pas une URL valide")
     */
    private $googlePlus;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(message="Linkedin n'est pas une URL valide")
     */
    private $linkedin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pays")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Pays ne doit pas être vide.")
     */
    private $pays;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Count(
     *     min="1",
     *     max="20",
     *     minMessage="Catégorie doit contenir au minimum ({{ limit }}) élément",
     *     maxMessage="Catégorie doit contenir au  maximum ({{ limit }}) éléments."
     * )
     */
    private $categories;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Avatar", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $avatar;

    /**
     * @ORM\OneToOne(targetEntity="Utilisateur", inversedBy="formateur", cascade={"all"})
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Valid()
     */
    private $utilisateur;

    public function nomUnique(){
        return $this->getUtilisateur()->uniqueNom();
    }

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getGooglePlus(): ?string
    {
        return $this->googlePlus;
    }

    public function setGooglePlus(?string $googlePlus): self
    {
        $this->googlePlus = $googlePlus;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

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

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categorie $category): self
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

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
