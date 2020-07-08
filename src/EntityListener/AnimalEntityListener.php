<?php

namespace App\EntityListener;

use App\Entity\Animal;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class AnimalEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Animal $animal, LifecycleEventArgs $event)
    {
        $animal->computeSlug($this->slugger);
    }

    public function preUpdate(Animal $animal, LifecycleEventArgs $event)
    {
        $animal->computeSlug($this->slugger);
    }
}