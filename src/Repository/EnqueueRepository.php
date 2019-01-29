<?php

namespace App\Repository;

use App\Entity\Enqueue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Enqueue|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enqueue|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enqueue[]    findAll()
 * @method Enqueue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnqueueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Enqueue::class);
    }

    // /**
    //  * @return Enqueue[] Returns an array of Enqueue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Enqueue
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
