<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @ORM\Table(name="utilisateur")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("email", message="Cet email est déjà utilisé")
 * @ORM\HasLifecycleCallbacks()
 */
class Utilisateur implements UserInterface, \Serializable, EquatableInterface
{
    const ROLE_DEFAULT = 'ROLE_USER';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="email", type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Email ne doit pas être vide.")
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Mot de passe ne doit pas être vide.", groups={"registration", "change_password"})
     * @Assert\Length(
     *     min="4",
     *     max="32",
     *     minMessage="Mot de passe doit avoir au minimum ({{ limit }}) caractères.",
     *     maxMessage="Mot de passe doit avoir au maximum ({{ limit }}) caractères.",
     *     groups={"registration", "change_password"}
     * )
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=180)
     */
    private $password;

    /**
     * @ORM\Column(type="json_array", nullable=true)
     */
    private $roles;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(name="date_inscription", type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\Column(name="dernier_connexion", type="datetime", nullable=true)
     */
    private $dernierConnexion;

    /**
     * @ORM\Column(name="prenom", type="string", length=60, nullable=true)
     * @Assert\NotBlank(message="Prénom ne doit pas être vide.")
     */
    private $prenom;

    /**
     * @ORM\Column(name="nom", type="string", length=60, nullable=true)
     * @Assert\NotBlank(message="Nom ne doit pas être vide.")
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity="Formateur", mappedBy="utilisateur")
     * @Assert\Valid()
     */
    private $formateur;

    /**
     * @ORM\OneToOne(targetEntity="Etudiant", mappedBy="utilisateur")
     * @Assert\Valid()
     */
    private $etudiant;

    /**
     * @ORM\OneToOne(targetEntity="Administrateur", mappedBy="utilisateur")
     * @Assert\Valid()
     */
    private $administrateur;

    public function uniqueNom()
    {
        return sprintf('%s  %s', $this->prenom, $this->nom);
    }

    public function __construct()
    {
        $this->dateInscription = new \DateTime();
        $this->roles = array();
        $this->active = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $password): self
    {
        $this->plainPassword = $password;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles(): ?array
    {
        $roles = $this->roles;

        // give everyone ROLE_USER!
        if (!in_array(static::ROLE_DEFAULT, $roles)) {
            $roles[] = static::ROLE_DEFAULT;
        }
        return $roles;
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = array();

        foreach ($roles as $role) {
            $this->addRole($role);
        }

        return $this;
    }

    public function addRole($role)
    {
        $role = strtoupper($role);
        if ($role === static::ROLE_DEFAULT) {
            return $this;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    public function removeRole($role)
    {
        if (false !== $key = array_search(strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function isEqualTo(UserInterface $user)
    {
        /*if ($this->password !== $user->getPassword()) {
            return false;
        }

        if ($this->email !== $user->getUsername()) {
            return false;
        }*/

        return true;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getDernierConnexion(): ?\DateTimeInterface
    {
        return $this->dernierConnexion;
    }

    public function setDernierConnexion(?\DateTimeInterface $dernierConnexion): self
    {
        $this->dernierConnexion = $dernierConnexion;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getFormateur(): ?Formateur
    {
        return $this->formateur;
    }

    public function setFormateur(?Formateur $formateur): self
    {
        $this->formateur = $formateur;

        // set (or unset) the owning side of the relation if necessary
        $newUtilisateur = $formateur === null ? null : $this;
        if ($newUtilisateur !== $formateur->getUtilisateur()) {
            $formateur->setUtilisateur($newUtilisateur);
        }

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        // set (or unset) the owning side of the relation if necessary
        $newUtilisateur = $etudiant === null ? null : $this;
        if ($newUtilisateur !== $etudiant->getUtilisateur()) {
            $etudiant->setUtilisateur($newUtilisateur);
        }

        return $this;
    }

    public function getAdministrateur(): ?Administrateur
    {
        return $this->administrateur;
    }

    public function setAdministrateur(?Administrateur $administrateur): self
    {
        $this->administrateur = $administrateur;

        // set (or unset) the owning side of the relation if necessary
        $newUtilisateur = $administrateur === null ? null : $this;
        if ($newUtilisateur !== $administrateur->getUtilisateur()) {
            $administrateur->setUtilisateur($newUtilisateur);
        }

        return $this;
    }

}
