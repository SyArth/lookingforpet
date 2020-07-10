<?php

namespace App\Repository;

use App\Entity\Tatouage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tatouage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tatouage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tatouage[]    findAll()
 * @method Tatouage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TatouageRepository extends ServiceEntityRepository
{
    /**
     * TatouageRepository constructor
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tatouage::class);
    }
}
