<?php

namespace App\Controller\BackOffice;

use App\Entity\Formateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class FormateurController
 * @package App\Controller
 * @Route("/formateurs")
 */
class FormateurController extends AbstractController
{
    /**
     * @Route("/", name="back_formateur_liste")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function liste(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Formateur')->liste();
        $entities = $paginator->paginate($qb, $request->query->get('page', 1), 10);

        return $this->render('back_office/formateurs/liste.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * @Route("/voir/{id}", name="back_formateur_voir")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function voir(Request $request, Formateur $formateur)
    {
        return $this->render('back_office/formateurs/voir.html.twig', array(
            'formateur' => $formateur
        ));
    }

    /**
     * @Route("/activer/{id}", name="back_formateur_activer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function activer(Request $request, Formateur $formateur)
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest() && $formateur) {
            $em = $this->getDoctrine()->getManager();
            if ($formateur->getUtilisateur()->getActive()) {
                $formateur->getUtilisateur()->setActive(false);
                $this->addFlash('success', 'Formateur a été désactivé');
            } else {
                $formateur->getUtilisateur()->setActive(true);
                $this->addFlash('success', 'Formateur a été activé');
            }
            $em->flush();
        }
        return new JsonResponse();
    }
    

}