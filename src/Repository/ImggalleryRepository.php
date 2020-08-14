<?php

namespace App\Repository;

use App\Entity\Imggallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Imggallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imggallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imggallery[]    findAll()
 * @method Imggallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImggalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imggallery::class);
    }

    // /**
    //  * @return Imggallery[] Returns an array of Imggallery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Imggallery
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
