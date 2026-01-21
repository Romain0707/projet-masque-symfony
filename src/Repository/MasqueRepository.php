<?php

namespace App\Repository;

use App\Entity\Masque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Masque>
 */
class MasqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Masque::class);
    }

   /**
    * @return Masque[] Returns an array of Masque objects
    */
   public function findFour(): array
   {
       return $this->createQueryBuilder('m')
            ->leftJoin('m.colors', 'c')
            ->addSelect('c')
            ->setMaxResults( 4 )
            ->getQuery()
            ->getResult()
        ;
   }

//    public function findOneBySomeField($value): ?Masque
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
