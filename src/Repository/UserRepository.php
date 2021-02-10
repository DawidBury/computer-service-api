<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public static function available(ServiceEntityRepository $repository)
    {
        return $repository->createQueryBuilder('u')
            ->leftJoin('u.customer', 'c')
            ->where('c.user is NULL');
    }

    public static function availableEmployee(ServiceEntityRepository $repository)
    {
        return $repository->createQueryBuilder('u')
            ->leftJoin('u.employee', 'c')
            ->where('c.user is NULL');
    }
}
