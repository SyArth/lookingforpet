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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tatouage::class);
    }

    // /**
    //  * @return Tatouage[] Returns an array of Tatouage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tatouage
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
