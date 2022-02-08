<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private string $url;

    /**
     * @ORM\ManyToOne(targetEntity=Advert::class, inversedBy="photos")
     */
    private ?Advert $advert;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="photo", cascade={"persist", "remove"})
     */
    private ?User $user;

    /**
     * @ORM\OneToOne(targetEntity=Upload::class, mappedBy="photo", cascade={"persist", "remove"})
     */
    private ?Upload $upload;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {

        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getAdvert(): ?Advert
    {
        return $this->advert;
    }

    public function setAdvert(?Advert $advert): self
    {
        $this->advert = $advert;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUpload(): ?Upload
    {
        return $this->upload;
    }

    public function setUpload(Upload $upload): self
    {
        // set the owning side of the relation if necessary
        if ($upload->getPhoto() !== $this) {
            $upload->setPhoto($this);
        }

        $this->upload = $upload;

        return $this;
    }
}
