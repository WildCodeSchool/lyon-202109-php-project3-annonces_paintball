<?php

namespace App\Entity;

use App\Repository\AdvertRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdvertRepository::class)
 */
class Advert
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\Column(type="float")
     */
    private float $price;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $creationDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $updateDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?\DateTimeInterface $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $brand;

    public static array $BRANDS = [
        'Autres marques',
        'Armotech',
        'Azodin',
        'Base',
        'BT',
        'Bunker Kings',
        'Deadlywind',
        'DLX',
        'Dye',
        'Empire',
        'GI Sportz/V-Force',
        'HK Army',
        'Honorcore',
        'JT',
        'Lapco',
        'MacDev',
        'Milsig',
        'Oubtreak',
        'Planet Eclipse',
        'Powair',
        'Proto',
        'Sly',
        'Smart Parts/GOG',
        'Soger',
        'Spyder',
        'Tiberius',
        'Tippmann/Hammerhead',
        'Trident',
        'Valken',
        'Virtue',
        'WGP',
    ];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $useCondition;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="advert", cascade={"persist"})
     */
    private Collection $photos;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="adverts")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $category;

    public static array $CATEGORIES = [
        'Accessoires pour lanceurs',
        'Air comprimé et CO2',
        'Bagages et housses',
        'Canons',
        'Covoiturage',
        'Divers',
        'Kits et packages',
        'Lanceurs de scénario',
        'Lanceur de compétition',
        'Lanceurs de loisir',
        'Loaders et accessoires',
        'Masques et écrans',
        'Recrutements',
        'Tournois',
        'Terrains et accessoires',
        'Vetements de jeu',
    ];

    public static array $USECONDITIONS = [
        'Neuf',
        'Très bon état',
        'Bon état',
        'Satisfaisant',
        'Pour pièces',
    ];

    public static array $STATUS = [
        "En cours",
        "Vendues",
        "Abandonnées",
    ];

    public static array $REGIONS = [
        'Auvergne-Rhône-Alpes',
        'Bourgogne-Franche-Comté',
        'Bretagne',
        'Centre-Val de Loire',
        'Corse',
        'Grand Est',
        'Hauts-de-France',
        'Ile-de-France',
        'Normandie',
        'Nouvelle-Aquitaine',
        'Occitanie',
        'Pays de la Loire',
        'Provence-Alpes-Côte d’Azur',
    ];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $status;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getUseCondition(): ?string
    {
        return $this->useCondition;
    }

    public function setUseCondition(string $useCondition): self
    {
        $this->useCondition = $useCondition;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setAdvert($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getAdvert() === $this) {
                $photo->setAdvert(null);
            }
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
