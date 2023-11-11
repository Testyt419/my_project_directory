<?php

namespace App\Repository;

use App\Entity\PrizeNames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrizeNames>
 *
 * @method PrizeNames|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrizeNames|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrizeNames[]    findAll()
 * @method PrizeNames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrizeNamesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrizeNames::class);
    }

//    /**
//     * @return PrizeNames[] Returns an array of PrizeNames objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PrizeNames
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
