<?php

namespace App\Repository;

use App\Entity\Puce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Puce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Puce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Puce[]    findAll()
 * @method Puce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PuceRepository extends ServiceEntityRepository
{
    /**
     * PuceRepository constructor
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Puce::class);
    }
}
