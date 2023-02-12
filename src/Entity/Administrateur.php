<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Administrateur
 *
 * @ORM\Table(name="administrateur")
 * @ORM\Entity(repositoryClass="App\Repository\AdministrateurRepository")
 */
class Administrateur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="mobile", type="string", length=20, nullable=true)
     *
     * @Assert\Regex(
     *        "/^[0-9 ]+$/",
     *        message="Téléphone mobile: utiliser seulement des chiffres et espaces"
     * )
     * @Assert\Length(
     *     min=8,
     *     max="15",
     *     minMessage="Téléphone mobile doit être au moin 8 caractéres.",
     *     maxMessage="Téléphone mobile est trop long (max 20 caractéres)."
     *    )
     */
    protected $mobile;

    /**
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="App\Entity\Utilisateur", inversedBy="administrateur", cascade={"all"} , fetch="EAGER")
     * @ORM\JoinColumn(nullable= false)
     */
    private $utilisateur;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;
        $utilisateur->addRole('ROLE_ADMIN');
        return $this;
    }

}
