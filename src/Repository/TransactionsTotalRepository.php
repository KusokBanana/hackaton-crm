<?php

namespace App\Repository;

use App\Entity\TransactionsTotal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TransactionsTotal|null find($id, $lockMode = null, $lockVersion = null)
 * @method TransactionsTotal|null findOneBy(array $criteria, array $orderBy = null)
 * @method TransactionsTotal[]    findAll()
 * @method TransactionsTotal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionsTotalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TransactionsTotal::class);
    }

    // /**
    //  * @return TransactionsTotal[] Returns an array of TransactionsTotal objects
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
    public function findOneBySomeField($value): ?TransactionsTotal
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
