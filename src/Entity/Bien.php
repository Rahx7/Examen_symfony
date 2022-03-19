<?php

namespace App\Entity;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BienRepository;
use Symfony\Component\HttpFoundation\File\File;
// use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien implements \Serializable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[File( mimeTypes:["image/png", "image/jpeg"], mimeTypesMessage:"le format de fichier ne correspond pas")]
    private $photo;

    #[ORM\Column(type: 'integer')]
    private $room;

    #[ORM\Column(type: 'integer')]
    private $floor;

    #[ORM\Column(type: 'float')]
    private $surface;

    #[ORM\Column(type: 'integer')]
    private $prix;

    #[ORM\Column(type: 'string', length: 100)]
    private $type;

    #[ORM\Column(type: 'string', length: 50)]
    private $typeTransac;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dateConstruction;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $etage;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $surfaceTerrain;

    #[ORM\Column(type: 'text')]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\Column(type: 'array', nullable: true)]
    private $options = [];

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'biens')]
    #[ORM\JoinColumn(nullable: false)]
    private $agent;

    #[ORM\OneToMany(mappedBy: 'bien', targetEntity: Photo::class, orphanRemoval: true)]
    private $photos;

    #[ORM\Column(type: 'array', nullable: true)]
    private $photos2 = [];

    public function __construct()
    {
        $this->photos = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    #[ORM\PostRemove]
    public function deletPictures()
    {

        if (file_exists(__DIR__.'/../../public/upload/'. $this->photo)) {
            unlink(__DIR__.'/../../public/upload/'. $this->photo);
        }
        return true;
    }


    public function getRoom(): ?int
    {
        return $this->room;
    }

    public function setRoom(int $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeTransac(): ?string
    {
        return $this->typeTransac;
    }

    public function setTypeTransac(string $typeTransac): self
    {
        $this->typeTransac = $typeTransac;

        return $this;
    }

    public function getDateConstruction(): ?\DateTimeInterface
    {
        return $this->dateConstruction;
    }

    public function setDateConstruction(?\DateTimeInterface $dateConstruction): self
    {
        $this->dateConstruction = $dateConstruction;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(?int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getSurfaceTerrain(): ?int
    {
        return $this->surfaceTerrain;
    }

    public function setSurfaceTerrain(?int $surfaceTerrain): self
    {
        $this->surfaceTerrain = $surfaceTerrain;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): self
    {
        $this->options = $options;

        return $this;
    }



    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function __toString()
    {
        $text = $this->titre.' avec l\'id '.$this->id;
        return  $text; 
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setBien($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getBien() === $this) {
                $photo->setBien(null);
            }
        }

        return $this;
    }

    public function getPhotos2(): ?array
    {
        return $this->photos2;
    }

    public function setPhotos2(?array $photos2): self
    {
        $this->photos2 = $photos2;

        return $this;
    }

 
    public function serialize() {

        return serialize(array(
        $this->id,

        ));
        
        }
        
        public function unserialize($serialized) {
        
        list (
        $this->id,

        ) = unserialize($serialized);
        }
    ////////////////////// test 
    // public function serialize()
    // {
    //     return serialize(array(
    //         $this->id,
    //         $this->username,
    //         $this->password,
    //         // see section on salt below
    //         // $this->salt,
    //     ));
    // }

    // public function unserialize($serialized)
    // {
    //     list (
    //         $this->id,
    //         $this->username,
    //         $this->password,
    //         // see section on salt below
    //         // $this->salt
    //     ) = unserialize($serialized);
    // }



}
