<?php

namespace App\Repository;

use App\Entity\ForumReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ForumReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForumReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForumReponse[]    findAll()
 * @method ForumReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForumReponseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForumReponse::class);
    }

    // /**
    //  * @return ForumReponse[] Returns an array of ForumReponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ForumReponse
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
