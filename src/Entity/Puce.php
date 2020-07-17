<?php

namespace App\Entity;

use App\Repository\PuceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PuceRepository::class)
 * @UniqueEntity(fields={"numero"}, message="Un animal a déjà ce numero de puce.")
 */
class Puce
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

   
    /**
     * @ORM\OneToOne(targetEntity=Animal::class, inversedBy="puce", cascade={"persist", "remove"})
     * 
     */
    private $animal;

    /**
     * @ORM\Column(type="string", length=15, nullable=true, unique=true)
     * @Assert\Regex(pattern="/^[0-9]{3}[0-9]{2}[0-9]{2}[0-9]{8}$/")
     *
     */
    private $numero;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
    
    public function __toString()
    {
        return $this->numero;
    }
}
