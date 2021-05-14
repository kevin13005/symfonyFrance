<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RegionRepository;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 * @UniqueEntity("slug")
 * @Vich\Uploadable
 */
class Region
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="region_images", fileNameProperty="image")
     * 
     * @var File|null
     */
    private $imageFile;

      /**
     * @ORM\Column(type="datetime")
     *
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Offre::class, mappedBy="regions")
     */
    private $offres;


    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->imagesRegion = new ArrayCollection();
        $this->offres = new ArrayCollection();
        $this->updatedAt = new \DateTime();
    }

    public function computeSlug(SluggerInterface $slugger)
    {
        if (!$this->slug || '-' === $this->slug) {
            $this->slug = (string) $slugger->slug((string) $this)->lower();
        }
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
    /**
     * @return $mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     *@param File|null $imageFile
     *@return $this
     */
    public function setImageFile(File $imageFile): self
    {
        $this->imageFile = $imageFile;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if (null !== $imageFile) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

  
   

    public function __toString()
    {
        return $this->getNom();
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

    /**
     * @return Collection|Offre[]
     */
    public function getOffres(): Collection
    {
        return $this->offres;
    }

    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->addRegion($this);
        }

        return $this;
    }

    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->removeElement($offre)) {
            $offre->removeRegion($this);
        }

        return $this;
    }
    

}
