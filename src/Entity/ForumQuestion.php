<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ForumQuestionRepository")
 */
class ForumQuestion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(name="slug", type="string", length=180, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $texte;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ordre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForumReponse", mappedBy="question", orphanRemoval=true)
     */
    private $forumReponses;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->ordre = new \DateTime();
        $this->forumReponses = new ArrayCollection();
    }

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

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getOrdre(): ?\DateTimeInterface
    {
        return $this->ordre;
    }

    public function setOrdre(\DateTimeInterface $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection|ForumReponse[]
     */
    public function getForumReponses(): Collection
    {
        return $this->forumReponses;
    }

    public function addForumReponse(ForumReponse $forumReponse): self
    {
        if (!$this->forumReponses->contains($forumReponse)) {
            $this->forumReponses[] = $forumReponse;
            $forumReponse->setQuestion($this);
        }

        return $this;
    }

    public function removeForumReponse(ForumReponse $forumReponse): self
    {
        if ($this->forumReponses->contains($forumReponse)) {
            $this->forumReponses->removeElement($forumReponse);
            // set the owning side to null (unless already changed)
            if ($forumReponse->getQuestion() === $this) {
                $forumReponse->setQuestion(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
