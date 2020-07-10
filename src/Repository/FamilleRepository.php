<?php

namespace App\Repository;

use App\Entity\Famille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Famille|null find($id, $lockMode = null, $lockVersion = null)
 * @method Famille|null findOneBy(array $criteria, array $orderBy = null)
 * @method Famille[]    findAll()
 * @method Famille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilleRepository extends ServiceEntityRepository
{
    /**
     * FamilleRepository constructor
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Famille::class);
    }
}
