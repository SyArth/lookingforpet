<?php

namespace App\Entity;

use App\Repository\PuceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PuceRepository::class)
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $puce;

    /**
     * @ORM\OneToOne(targetEntity=Animal::class, inversedBy="puce", cascade={"persist", "remove"})
     */
    private $animal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPuce(): ?bool
    {
        return $this->puce;
    }

    public function setPuce(?bool $puce): self
    {
        $this->puce = $puce;

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
}
