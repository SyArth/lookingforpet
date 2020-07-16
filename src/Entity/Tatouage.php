<?php

namespace App\Entity;

use App\Repository\TatouageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=TatouageRepository::class)
 * @UniqueEntity(fields={"numero"}, message="Un animal a déjà ce tatouage.")
 */
class Tatouage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true, unique=true)
     * @Assert\Regex(pattern="/^[0-9][A-Z]{3}[0-9]{3}$/")
     */
    private $numero;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, inversedBy="tatouage", cascade={"persist", "remove"})
     */
    private $animal;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }
}
