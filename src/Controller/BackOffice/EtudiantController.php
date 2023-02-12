<?php

namespace App\Controller\BackOffice;

use App\Entity\Etudiant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class EtudiantController
 * @package App\Controller
 * @Route("/etudiants")
 */
class EtudiantController extends AbstractController
{
    /**
     * @Route("/", name="back_etudiant_liste")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function liste(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Etudiant')->findBy(array(), array('id'=> 'desc'));
        $entities = $paginator->paginate($qb, $request->query->get('page', 1), 40);

        return $this->render('back_office/etudiants/liste.html.twig', array(
            'entities' => $entities
        ));
    }


    /**
     * @Route("/voir/{id}", name="back_etudiant_voir")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function voir(Request $request, Etudiant $etudiant)
    {
        return $this->render('back_office/etudiants/voir.html.twig', array(
            'entity' => $etudiant
        ));
    }

    /**
     * @Route("/activer/{id}", name="back_etudiant_activer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function activer(Request $request, Etudiant $etudiant)
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest() && $etudiant) {
            $em = $this->getDoctrine()->getManager();
            if ($etudiant->getUtilisateur()->getActive()) {
                $etudiant->getUtilisateur()->setActive(false);
                $this->addFlash('success', 'Etudiant a été désactivé');
            } else {
                $etudiant->getUtilisateur()->setActive(true);
                $this->addFlash('success', 'Etudiant a été activé');
            }
            $em->flush();
        }
        return new JsonResponse();
    }


}