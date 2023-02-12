<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Message::class);
    }


    public function listeNonLu()
    {
        $qb = $this->createQueryBuilder('e')
            ->where('e.lu = false')
            ->orderBy('e.id', 'DESC');

        return $qb;
    }

    public function nombreMessagesNonLu(){
        return $this->createQueryBuilder('e')
            ->select('COUNT(e)')
            ->where('e.lu = false')
            ->getQuery()
            ->getSingleScalarResult();
    }
}
