<?php

namespace App\Repository;

use App\Entity\QuizReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuizReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizReponse[]    findAll()
 * @method QuizReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizReponseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuizReponse::class);
    }

    public function mesReponse($lesson, $etudiant)
    {
        return $this->createQueryBuilder('r')
            ->leftJoin('r.quiz', 'q')
            ->where('r.etudiant = :etudiant')
            ->setParameter('etudiant', $etudiant)
            ->andWhere('q.lesson = :lesson')
            ->setParameter('lesson', $lesson)
            ->getQuery()->getResult();
    }
}
