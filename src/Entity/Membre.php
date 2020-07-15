<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\ORM\Mapping\HasLifecycleCallbacks;


/**
 * @ORM\Entity(repositoryClass=MembreRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Membre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
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
    private $prenom;

   
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Signalement::class, mappedBy="membre")
     */
    private $signalements;

     /**
     * @ORM\OneToMany(targetEntity=Retrouve::class, mappedBy="membre")
     */
    private $retrouves;

    /**
     * @ORM\OneToOne(targetEntity=Adresse::class, mappedBy="membre", cascade={"persist", "remove"})
     */
    private $adresse;

    
    /**
     * @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=Animal::class, mappedBy="membre", orphanRemoval=true)
     */
    private $animaux;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="membre", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Membre constructor
     */
    public function __construct()
    {
        $this->signalements = new ArrayCollection();
        $this->retrouves = new ArrayCollection();
        $this->animaux = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
            $signalement->setMembre($this);
        }

        return $this;
    }

    public function removeSignalement(Signalement $signalement): self
    {
        if ($this->signalements->contains($signalement)) {
            $this->signalements->removeElement($signalement);
            // set the owning side to null (unless already changed)
            if ($signalement->getMembre() === $this) {
                $signalement->setMembre(null);
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
            $retrouve->setMembre($this);
        }

        return $this;
    }

    public function removeRetrouve(Retrouve $retrouve): self
    {
        if ($this->retrouves->contains($retrouve)) {
            $this->retrouves->removeElement($retrouve);
            // set the owning side to null (unless already changed)
            if ($retrouve->getMembre() === $this) {
                $retrouve->setMembre(null);
            }
        }

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        // set (or unset) the owning side of the relation if necessary
        $newMembre = null === $adresse ? null : $this;
        if ($adresse->getMembre() !== $newMembre) {
            $adresse->setMembre($newMembre);
        }

        return $this;
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

    /**
     * @ORM\PrePersist
     * @return void
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|Animal[]
     */
    public function getAnimaux(): Collection
    {
        return $this->animaux;
    }

    public function addAnimaux(Animal $animaux): self
    {
        if (!$this->animaux->contains($animaux)) {
            $this->animaux[] = $animaux;
            $animaux->setMembre($this);
        }

        return $this;
    }

    public function removeAnimaux(Animal $animaux): self
    {
        if ($this->animaux->contains($animaux)) {
            $this->animaux->removeElement($animaux);
            // set the owning side to null (unless already changed)
            if ($animaux->getMembre() === $this) {
                $animaux->setMembre(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        // set (or unset) the owning side of the relation if necessary
        $newMembre = null === $user ? null : $this;
        if ($user->getMembre() !== $newMembre) {
            $user->setMembre($newMembre);
        }

        return $this;
    }
}
