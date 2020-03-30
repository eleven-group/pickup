<?php

namespace App\Repository;

use App\Entity\Payslip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Payslip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payslip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payslip[]    findAll()
 * @method Payslip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PayslipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payslip::class);
    }

    // /**
    //  * @return Payslip[] Returns an array of Payslip objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Payslip
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
