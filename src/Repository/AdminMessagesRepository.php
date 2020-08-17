<?php

namespace App\Repository;

use App\Entity\AdminMessages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdminMessages|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminMessages|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminMessages[]    findAll()
 * @method AdminMessages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminMessagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminMessages::class);
    }

    // /**
    //  * @return AdminMessages[] Returns an array of AdminMessages objects
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
    public function findOneBySomeField($value): ?AdminMessages
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
