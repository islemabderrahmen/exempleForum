<?php

namespace App\Listener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CoursFavorisListener
{
    protected
        $em,
        $security,
        $token;

    public function __construct(EntityManagerInterface $em, AuthorizationCheckerInterface $security, TokenStorageInterface $token)
    {
        $this->em = $em;
        $this->security = $security;
        $this->token = $token;
    }

    public function getCoursEnFavoris()
    {
        if ($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $utilisateur = $this->token->getToken()->getUser();

            $favoris = $this->em->getRepository('App:FavorisCours')->findBy(array('utilisateur' => $utilisateur));
            $ids = array_map(function ($entity) {
                return $entity->getCours()->getId();
            }, $favoris); // get ids of cours in favorite
        } else {
            $ids = array(); // if utilisateur is not AUTHENTICATED_REMEMBERED show ids are null
        }

        return $ids;
    }

    public function verifierSiCoursDejaEnFavoris($cours)
    {
        if ($this->security->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $utilisateur = $this->token->getToken()->getUser();

            $isInfavorites = $this->em->getRepository('App:FavorisCours')->findOneBy(array('utilisateur' => $utilisateur, 'cours' => $cours));
            $result = $isInfavorites;
        } else {
            $result = false; // if utilisateur is not AUTHENTICATED_REMEMBERED show null
        }

        return $result;
    }
}
