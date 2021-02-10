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

    public function getAllActiveCMS(): array
    {
        return $this->createQueryBuilder('c')
            ->where('c.active = true')
            ->getQuery()
            ->getResult()
        ;
    }
}
