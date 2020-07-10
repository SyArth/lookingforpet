<?php

namespace App\Repository;

use App\Entity\Retrouve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Retrouve|null find($id, $lockMode = null, $lockVersion = null)
 * @method Retrouve|null findOneBy(array $criteria, array $orderBy = null)
 * @method Retrouve[]    findAll()
 * @method Retrouve[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RetrouveRepository extends ServiceEntityRepository
{
    /**
     * RetrouveRepository constructor
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Retrouve::class);
    }
}
