<?php

namespace App\Repository;

use App\Entity\EvaluationCours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EvaluationCours|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvaluationCours|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvaluationCours[]    findAll()
 * @method EvaluationCours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluationCoursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EvaluationCours::class);
    }

    public function totalParCours($id)
    {
        return $this->createQueryBuilder('e')
            ->select('SUM(e.nombre)')
            ->where('e.cours = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function nombreParCours($id)
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e)')
            ->where('e.cours = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
