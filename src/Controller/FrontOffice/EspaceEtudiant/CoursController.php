<?php

namespace App\Controller\FrontOffice\EspaceEtudiant;

use App\Entity\Cours;
use App\Listener\CoursFavorisListener;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @Route("/cours")
 */
class CoursController extends AbstractController
{

    /**
     * @Route("/mes-favoris", name="espace_etudiant_cours_en_favoris")
     * @Security("has_role('ROLE_ETUDIANT')")
     */
    public function listeEnFavoris(Request $request, PaginatorInterface $paginator)
    {
        $utilisateur = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:FavorisCours')->findBy(array('utilisateur' => $utilisateur), array('id' => 'desc'));
        $favoris = $paginator->paginate($qb, $request->query->get('page', 1), 20);

        return $this->render('front_office/espace_etudiant/cours/liste_en_favoris.html.twig', array(
            'favoris' => $favoris
        ));
    }
}