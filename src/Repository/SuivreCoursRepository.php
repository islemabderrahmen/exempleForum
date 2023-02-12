<?php

namespace App\Repository;

use App\Entity\SuivreCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SuivreCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuivreCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuivreCours[]    findAll()
 * @method SuivreCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuivreCoursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SuivreCours::class);
    }

    // /**
    //  * @return SuivreCours[] Returns an array of SuivreCours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SuivreCours
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
