<?php

namespace App\Repository;

use App\Entity\QuizEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuizEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizEtudiant[]    findAll()
 * @method QuizEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuizEtudiant::class);
    }

    public function notesParCours($formateur, $cours)
    {
        return $this->createQueryBuilder('n')
            ->leftJoin('n.lesson', 'l')
            ->leftJoin('l.cours', 'c')
            ->where('c.formateur = :formateur')
            ->andwhere('l.cours = :cours')
            ->setParameter('cours', $cours)
            ->setParameter('formateur', $formateur)
            ->getQuery()->getResult();
    }

    public function notes($formateur)
    {
        return $this->createQueryBuilder('n')
            ->leftJoin('n.lesson', 'l')
            ->leftJoin('l.cours', 'c')
            ->where('c.formateur = :formateur')
            ->setParameter('formateur', $formateur)
            ->getQuery()->getResult();
    }
}
