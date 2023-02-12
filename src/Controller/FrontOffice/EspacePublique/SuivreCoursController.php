<?php

namespace App\Controller\FrontOffice\EspacePublique;

use App\Entity\Notification;
use App\Entity\SuivreCours;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/suivre-cours")
 */
class SuivreCoursController extends AbstractController
{

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/ajouter", name="front_suivre_cours_ajouter")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function ajouter(Request $request)
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest()) {
            $utilisateur = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $id = $request->request->get('id');
            $cours = $em->getRepository('App:Cours')->findOneBy(array('id' => $id));
            if (!$cours) {
                $this->addFlash('error', 'Erreur');
                return new JsonResponse();
            }
            $coursDejaEnFavoris = $em->getRepository('App:SuivreCours')->findOneBy(
                array('utilisateur' => $utilisateur, 'cours' => $cours)
            );
            if ($coursDejaEnFavoris) {
                $this->addFlash('error', 'Erreur');
                return new JsonResponse();
            }

            $suivreCours = new SuivreCours();
            $suivreCours->setUtilisateur($utilisateur);
            $suivreCours->setCours($cours);
            $em->persist($suivreCours);
            $em->flush();

            $notification = new Notification();
            $notification->setType('inscription_cours');
            $notification->setDescription('Nouvelle inscription dans un cours');
            $notification->setUtilisateur($cours->getFormateur()->getUtilisateur());
            $notification->setUrl($this->generateUrl('espace_formateur_cours_etudiant_inscris', array('id'=>$cours->getId())));
            $em->persist($notification);
            $em->flush();


            $this->addFlash('success', 'Ajouté aux liste à suivre');
        }

        return new JsonResponse();

    }


    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/supprimer", name="front_suivre_cours_supprimer")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function supprimer(Request $request)
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest()) {
            $utilisateur = $this->getUser();
            $em = $this->getDoctrine()->getManager();
            $id = $request->request->get('id');
            $cours = $em->getRepository('App:Cours')->findOneBy(array('id' => $id));
            if (!$cours) {
                $this->addFlash('error', 'Erreur');
                return new JsonResponse();
            }
            $suivreCours = $em->getRepository('App:SuivreCours')->findOneBy(
                array('utilisateur' => $utilisateur, 'cours' => $cours)
            );
            if (!$suivreCours) {

                return new JsonResponse();
            }
            $em->remove($suivreCours);
            $em->flush();
            $this->addFlash('success', 'Supprimée de la liste de suivre');
        }

        return new JsonResponse();
    }

}