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

}
