<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="cours")
 * @ORM\Entity(repositoryClass="App\Repository\CoursRepository")
 */
class Cours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="titre", type="string", length=160)
     * @Assert\NotBlank(message="Titre ne doit pas etre vide")
     * @Assert\Length(min="5", max="160")
     */
    private $titre;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(name="slug", type="string", length=180, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Assert\NotBlank(message="il faut saisir une description")
     */
    private $description;

    /**
     * @ORM\Column(name="niveau", type="string", length=50)
     */
    private $niveau;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="cours")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="Formateur")
     */
    private $formateur;

    /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"all"})
     * @Assert\Valid()
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="MediaVideo", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $video;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lesson", mappedBy="cours", orphanRemoval=true)
     */
    private $lessons;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SuivreCours", mappedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $suivres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EvaluationCours", mappedBy="cours", orphanRemoval=true)
     */
    private $evaluationCours;

    function convertToHoursMins()
    {
        $format = '%02dh%02d';
        $time = 0;
        foreach ($this->getLessons() as $lesson) {
            $time = $time + $lesson->getDuree();
        }
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    private $nombreEtoiles;

    public function getNombreEtoiles()
    {
        return $this->nombreEtoiles;
    }

    public function setNombreEtoiles($nombreEtoiles)
    {
        $this->nombreEtoiles = $nombreEtoiles;

        return $this;
    }

    public function __construct()
    {
        $this->dateCreation = new \DateTime();
        $this->lessons = new ArrayCollection();
        $this->suivres = new ArrayCollection();
        $this->evaluationCours = new ArrayCollection();
    }

    /**
     * @return Collection|Lesson[]
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): self
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons[] = $lesson;
            $lesson->setCours($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): self
    {
        if ($this->lessons->contains($lesson)) {
            $this->lessons->removeElement($lesson);
            // set the owning side to null (unless already changed)
            if ($lesson->getCours() === $this) {
                $lesson->setCours(null);
            }
        }

        return $this;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return html_entity_decode(htmlspecialchars_decode($this->description, ENT_QUOTES));
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

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

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): self
    {
        $this->formateur = $formateur;

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(?Image $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVideo(): ?MediaVideo
    {
        return $this->video;
    }

    public function setVideo(?MediaVideo $video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection|SuivreCours[]
     */
    public function getSuivres(): Collection
    {
        return $this->suivres;
    }

    public function addSuivre(SuivreCours $suivre): self
    {
        if (!$this->suivres->contains($suivre)) {
            $this->suivres[] = $suivre;
            $suivre->setCours($this);
        }

        return $this;
    }

    public function removeSuivre(SuivreCours $suivre): self
    {
        if ($this->suivres->contains($suivre)) {
            $this->suivres->removeElement($suivre);
            // set the owning side to null (unless already changed)
            if ($suivre->getCours() === $this) {
                $suivre->setCours(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EvaluationCours[]
     */
    public function getEvaluationCours(): Collection
    {
        return $this->evaluationCours;
    }

    public function addEvaluationCour(EvaluationCours $evaluationCour): self
    {
        if (!$this->evaluationCours->contains($evaluationCour)) {
            $this->evaluationCours[] = $evaluationCour;
            $evaluationCour->setCours($this);
        }

        return $this;
    }

    public function removeEvaluationCour(EvaluationCours $evaluationCour): self
    {
        if ($this->evaluationCours->contains($evaluationCour)) {
            $this->evaluationCours->removeElement($evaluationCour);
            // set the owning side to null (unless already changed)
            if ($evaluationCour->getCours() === $this) {
                $evaluationCour->setCours(null);
            }
        }

        return $this;
    }

}