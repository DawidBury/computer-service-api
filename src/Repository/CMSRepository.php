<?php

namespace App\Repository;

use App\Entity\CMS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CMS|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMS|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMS[]    findAll()
 * @method CMS[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMS::class);
    }

    // /**
    //  * @return CMS[] Returns an array of CMS objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CMS
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
