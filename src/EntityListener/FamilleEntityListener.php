<?php

namespace App\EntityListener;

use App\Entity\Famille;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class FamilleEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Famille $famille, LifecycleEventArgs $event)
    {
        $famille->computeSlug($this->slugger);
    }

    public function preUpdate(Famille $famille, LifecycleEventArgs $event)
    {
        $famille->computeSlug($this->slugger);
    }
}