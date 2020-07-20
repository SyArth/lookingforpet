<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=AnimalRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Animal
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Regex(pattern="/^[A-Z]{3}[0-9]{4}$/")
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $created_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="animaux")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Famille::class, inversedBy="animaux")
     * @ORM\JoinColumn(name="famille_id", referencedColumnName="id")
     */
    private $famille;

    /**
     * @ORM\OneToOne(targetEntity=Tatouage::class, mappedBy="animal", cascade={"persist", "remove"})
     */
    private $tatouage;

    /**
     * @ORM\OneToOne(targetEntity=Puce::class, mappedBy="animal", cascade={"persist", "remove"})
     */
    private $puce;

    /**
     * @ORM\OneToMany(targetEntity=Lieu::class, mappedBy="animal")
     */
    private $lieux;

    /**
     * @ORM\OneToMany(targetEntity=Signalement::class, mappedBy="animal")
     */
    private $signalements;

     /**
     * @ORM\OneToMany(targetEntity=Retrouve::class, mappedBy="animal")
     */
    private $retrouves;

    /**
    * @ORM\OneToMany(targetEntity=Image::class, mappedBy="animal", orphanRemoval=true, cascade={"persist"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $images;


    /**
     * Animal constructor
     */
    public function __construct()
    {
        $this->lieux = new ArrayCollection();
        $this->signalements = new ArrayCollection();
        $this->retrouves = new ArrayCollection();
        $this->images = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function computeSlug(SluggerInterface $slugger)
    {
        if(!$this->slug || '-' === $this->slug){
            $this->slug = (string) $slugger->slug((string) $this)->lower();
        }
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @return void
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFamille(): ?Famille
    {
        return $this->famille;
    }

    public function setFamille(?Famille $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getTatouage(): ?Tatouage
    {
        return $this->tatouage;
    }

    public function setTatouage(Tatouage $tatouage): self
    {
        $this->tatouage = $tatouage;

        // set the owning side of the relation if necessary
        if ($tatouage->getAnimal() !== $this) {
            $tatouage->setAnimal($this);
        }

        return $this;
    }

    public function getPuce(): ?Puce
    {
        return $this->puce;
    }

    public function setPuce(?Puce $puce): self
    {
        $this->puce = $puce;

        // set (or unset) the owning side of the relation if necessary
        $newAnimal = null === $puce ? null : $this;
        if ($puce->getAnimal() !== $newAnimal) {
            $puce->setAnimal($newAnimal);
        }

        return $this;
    }

    /**
     * @return Collection|Lieu[]
     */
    public function getLieux(): Collection
    {
        return $this->lieux;
    }

    public function addLieux(Lieu $lieux): self
    {
        if (!$this->lieux->contains($lieux)) {
            $this->lieux[] = $lieux;
            $lieux->setAnimal($this);
        }

        return $this;
    }

    public function removeLieux(Lieu $lieux): self
    {
        if ($this->lieux->contains($lieux)) {
            $this->lieux->removeElement($lieux);
            // set the owning side to null (unless already changed)
            if ($lieux->getAnimal() === $this) {
                $lieux->setAnimal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Signalement[]
     */
    public function getSignalements(): Collection
    {
        return $this->signalements;
    }

    public function addSignalement(Signalement $signalement): self
    {
        if (!$this->signalements->contains($signalement)) {
            $this->signalements[] = $signalement;
            $signalement->setAnimal($this);
        }

        return $this;
    }

    public function removeSignalement(Signalement $signalement): self
    {
        if ($this->signalements->contains($signalement)) {
            $this->signalements->removeElement($signalement);
            // set the owning side to null (unless already changed)
            if ($signalement->getAnimal() === $this) {
                $signalement->setAnimal(null);
            }
        }

        return $this;
    }

     /**
     * @return Collection|Retrouve[]
     */
    public function getRetrouves(): Collection
    {
        return $this->retrouves;
    }

    public function addRetrouve(Retrouve $retrouve): self
    {
        if (!$this->retrouves->contains($retrouve)) {
            $this->retrouves[] = $retrouve;
            $retrouve->setAnimal($this);
        }

        return $this;
    }

    public function removeRetrouve(Retrouve $retrouve): self
    {
        if ($this->retrouves->contains($retrouve)) {
            $this->retrouves->removeElement($retrouve);
            // set the owning side to null (unless already changed)
            if ($retrouve->getAnimal() === $this) {
                $retrouve->setAnimal(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAnimal($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getAnimal() === $this) {
                $image->setAnimal(null);
            }
        }

        return $this;
    }

   
}
