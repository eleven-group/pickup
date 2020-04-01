<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Shop;
/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function getSlots($shopId, $page = 1)
    {

        $start = mktime(0, 0, 0, date("m")  , date("d")+(7*($page-1)), date("Y"));
        $end = mktime(0, 0, 0, date("m")  , date("d")+(7*($page)), date("Y"));

        $start = date('Y-m-d H:i:s',$start);
        $end = date('Y-m-d H:i:s',$end);


        $qb = $this->createQueryBuilder('b')
            ->where('b.date BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->andWhere("b.status = :one OR b.status = :two")
            ->setParameter('one', 'pending')
            ->setParameter('two', 'accepted')
            ->andWhere("b.shop = :shop")
            ->setParameter('shop', $shopId);

        $query = $qb->getQuery();

        return $query->execute();
    }


    // /**
    //  * @return Booking[] Returns an array of Booking objects
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
    public function findOneBySomeField($value): ?Booking
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
