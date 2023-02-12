<?php

namespace App\Repository;

use App\Entity\Cours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cours|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cours|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cours[]    findAll()
 * @method Cours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoursRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cours::class);
    }

    public function nombreCours()
    {
        return $this->createQueryBuilder('e')
            ->select('COUNT(e)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function chercher($data)
    {
        $qb = $this->createQueryBuilder('e')
            ->leftJoin('e.categorie', 'cat')
            ->orderBy('e.id', 'DESC');

        if (!empty($data['motCle'])) {
            $qb->andWhere('e.titre like :motCle')
                ->setParameter('motCle', '%' . $data['motCle'] . '%');
        }
        if (!empty($data['categorie'])) {
            $qb->andWhere('e.categorie = :categorie')
                ->setParameter('categorie', $data['categorie']);
        }
        if (!empty($data['formateur'])) {
            $qb->andWhere('e.formateur = :formateur')
                ->setParameter('formateur', $data['formateur']);
        }
        if (!empty($data['niveau'])) {
            $qb->andWhere('e.niveau = :niveau')
                ->setParameter('niveau', $data['niveau']);
        }

        return $qb;
    }
}
