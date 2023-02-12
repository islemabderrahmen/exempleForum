<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="nom", type="string", length=60)
     * @Assert\NotBlank(message="Nom vide.")
     * @Assert\Length(
     *     min=3,
     *     max="50",
     *     minMessage="Nom est court",
     *     maxMessage="Nom est long."
     *    )
     */
    private $nom;

    /**
     * @ORM\Column(name="email", type="string", length=100)
     * @Assert\Email(message="Email non valide.")
     * @Assert\NotBlank(message="Email est vide")
     */
    private $email;

    /**
     * @ORM\Column(name="telephone", type="string", length=20, nullable=true)
     * @Assert\Regex(
     *        "/^[0-9 ]+$/",
     *        message="Téléphone: utiliser seulement des chiffres et espaces"
     * )
     * @Assert\Length(
     *     min=8,
     *     max="20",
     *     minMessage="Téléphone doit être au moin 8 caractéres.",
     *     maxMessage="Téléphone est trop long (max 20 caractéres)."
     *    )
     */
    private $telephone;

    /**
     * @ORM\Column(name="sujet", type="string", length=255)
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="Sujet est court.",
     *     maxMessage="Sujet est long, max 255)."
     *    )
     * @Assert\NotBlank(message="Sujet est vide")
     */
    private $sujet;

    /**
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank(message="Message est vide")
     * @Assert\Length(
     *     min=10,
     *     minMessage="Message est court.",
     *    )
     */
    private $contenu;

    /**
     * @ORM\Column(name="da7", type="datetime")
     */
    private $dateEnvoi;

    /**
     * @ORM\Column(name="lu", type="boolean")
     */
    private $lu;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->dateEnvoi = new \DateTime();
        $this->lu = false;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    public function getLu(): ?bool
    {
        return $this->lu;
    }

    public function setLu(bool $lu): self
    {
        $this->lu = $lu;

        return $this;
    }


}
