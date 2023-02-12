<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuizReponseRepository")
 */
class QuizReponse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Quiz")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quiz;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuizQuestion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $choix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etudiant")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiant;

    /**
     * @ORM\Column(type="boolean")
     */
    private $resultat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuiz(): ?Quiz
    {
        return $this->quiz;
    }

    public function setQuiz(?Quiz $quiz): self
    {
        $this->quiz = $quiz;

        return $this;
    }

    public function getChoix(): ?QuizQuestion
    {
        return $this->choix;
    }

    public function setChoix(?QuizQuestion $choix): self
    {
        $this->choix = $choix;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getResultat(): ?bool
    {
        return $this->resultat;
    }

    public function setResultat(bool $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }
}
