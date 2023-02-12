<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Slideshow
 *
 * @ORM\Table(name="slideshow")
 * @ORM\Entity(repositoryClass="App\Repository\SlideshowRepository")
 * @UniqueEntity("name", message="Le nom doit être unique.")
 * @ORM\HasLifecycleCallbacks()
 */
class Slideshow
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="extension", type="string", length=4)
     */
    private $extension;
    
    /**
     * @ORM\Column(name="name", type="string", length=180, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(name="title", type="string", length=120, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="display_order", type="integer", unique=false)
     */
    private $displayOrder;

    /**
     * @Assert\Image(
     *     allowPortrait = false,
     *     minWidth = 1024,
     *     minHeight = 668,
     *     minWidthMessage="La largeur de la photo est petite ({{ width }}px). La largeur minimale attendue est de {{ min_width }}px.",
     *     minHeightMessage="La hauteur de la photo est petite ({{ height }}px). La hauteur minimale attendue est de {{ min_height }}px"
     * )
     */
    public $file;

    private $tempFilename;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDisplayOrder(): ?int
    {
        return $this->displayOrder;
    }

    public function setDisplayOrder(int $displayOrder): self
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        if (null !== $this->extension) {
            $this->tempFilename = $this->name;

            $this->extension = null;
            $this->name = null;
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null === $this->file) {
            return;
        }

        $this->extension = $this->file->guessExtension();

        $this->name = md5(uniqid('', true)).'.'.$this->extension;
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir() . '/' . $this->tempFilename;

            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $this->file->move($this->getUploadRootDir(), $this->name);
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        $this->tempFilename = $this->getUploadRootDir() . '/' . $this->name;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (file_exists($this->tempFilename)) {
            unlink($this->tempFilename);
        }
    }

    //folder
    public function getUploadDir()
    {
        return 'uploads/slideshow/images';
    }

    // path to folder web
    public function getUploadRootDir()
    {
        return __DIR__ . '/../../public/' . $this->getUploadDir();
    }


    public function getWebPath()
    {
        return $this->getUploadDir() . '/' . $this->getName();
    }

    /**
     * This is for delete cache when delete photos
     * @ORM\PreRemove()
     * @ORM\PreUpdate()
     */
    public function getPreWebPath()
    {
        return $this->getUploadDir() . '/' . $this->name;
    }

    /**
     * This is for delete cache when edit photos
     */
    public function getOldFile(): ?string
    {
        return $this->getUploadDir() . '/' . $this->tempFilename;
    }

}
