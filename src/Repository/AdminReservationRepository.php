<?php

namespace App\Repository;

use App\Entity\AdminReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdminReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminReservation[]    findAll()
 * @method AdminReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminReservation::class);
    }

    // /**
    //  * @return AdminReservation[] Returns an array of AdminReservation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdminReservation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
