<?php

namespace App\Entity;

use App\Repository\RetrouveRepository;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=RetrouveRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Retrouve
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $created_at;

    
    /**
     * @ORM\ManyToOne(targetEntity=Animal::class, inversedBy="retrouves")
     */
    private $animal;

    /**
     * @ORM\ManyToOne(targetEntity=Lieu::class, inversedBy="retrouves")
     */
    private $lieu;

    
    public function getId(): ?int
    {
        return $this->id;
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

  
    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }

    public function getLieu(): ?Lieu
    {
        return $this->lieu;
    }

    public function setLieu(?Lieu $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    
}
