<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    
    /**
     * AnimalRepository constructor
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    /**
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getPaginatedAnimaux(int $page, int $limit): Paginator
    {
        return new Paginator
        ( $this->createQueryBuilder("p")
            ->addSelect("u")
            ->join("p.user","u")
            ->setMaxResults($limit)
            ->setFirstResult(($page * $limit) - $limit)
        );
    }
}
