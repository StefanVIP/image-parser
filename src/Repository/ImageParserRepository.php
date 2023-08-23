<?php

namespace App\Repository;

use App\Entity\ImageParser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageParser>
 *
 * @method ImageParser|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageParser|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageParser[]    findAll()
 * @method ImageParser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageParserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageParser::class);
    }

//    /**
//     * @return ImageParser[] Returns an array of ImageParser objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImageParser
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
