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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Retrouve::class);
    }

    // /**
    //  * @return Retrouve[] Returns an array of Retrouve objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Retrouve
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
