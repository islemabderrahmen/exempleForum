<?php

namespace App\Repository;

use App\Entity\Quiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Quiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quiz[]    findAll()
 * @method Quiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Quiz::class);
    }


    public function liste($formateur, $lesson)
    {
        return $this->createQueryBuilder('q')
            ->leftJoin('q.lesson', 'l')
            ->leftJoin('l.cours', 'c')
            ->where('c.formateur = :formateur')
            ->andWhere('q.lesson = :lesson')
            ->setParameter('lesson', $lesson)
            ->setParameter('formateur', $formateur)
            ->orderBy('q.id', 'desc')

        ;
    }

    public function nombreQuizParCours($id)
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e)')
            ->leftJoin('e.lesson', 'lesson')
            ->leftJoin('lesson.cours', 'cours')
            ->where('cours.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();
    }

}
