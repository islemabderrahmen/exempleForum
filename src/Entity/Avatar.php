<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Avatar
 *
 * @ORM\Table(name="avatar")
 * @ORM\Entity(repositoryClass="App\Repository\AvatarRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Avatar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="extension", type="string", length=180)
     */
    private $extension;

    /**
     * @ORM\Column(name="name", type="string", length=180)
     */
    private $name;

    /**
     * @Assert\Image(
     *     minWidth = 120,
     *     minHeight = 150,
     *     minWidthMessage="La largeur de l'image est petite ({{ width }}px). La largeur minimale attendue est de {{ min_width }}px.",
     *     minHeightMessage="La hauteur de l'image est petite ({{ height }}px). La hauteur minimale attendue est de {{ min_height }}px"
     * )
     */
    public $file;

    private $tempFilename;

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

        $this->name = md5(uniqid('', true)) . '.' . $this->extension;
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
        return 'uploads/avatars';
    }

    // path to folder web
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../public/' . $this->getUploadDir();
    }

    public function getWebPath()
    {
        return $this->getUploadDir() . '/' . $this->getName();
    }


}
