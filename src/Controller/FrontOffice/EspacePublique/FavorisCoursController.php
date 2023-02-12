<?php

namespace App\Controller\FrontOffice\EspacePublique;

use App\Entity\FavorisCours;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/favoris-cours")
 */
class FavorisCoursController extends AbstractController
{

    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/ajouter", name="front_favoris_cours_ajouter")
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
            $coursDejaEnFavoris = $em->getRepository('App:FavorisCours')->findOneBy(
                array('utilisateur' => $utilisateur, 'cours' => $cours)
            );
            if ($coursDejaEnFavoris) {
                $this->addFlash('error', 'Erreur');
                return new JsonResponse();
            }

            $favorisCours = new FavorisCours();
            $favorisCours->setUtilisateur($utilisateur);
            $favorisCours->setCours($cours);
            $em->persist($favorisCours);
            $em->flush();
            $this->addFlash('success', 'Ajouté aux favoris');
        }

        return new JsonResponse();

    }


    /**
     * @param Request $request
     * @return JsonResponse
     *
     * @Route("/supprimer", name="front_favoris_cours_supprimer")
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
            $favorisCours = $em->getRepository('App:FavorisCours')->findOneBy(
                array('utilisateur' => $utilisateur, 'cours' => $cours)
            );
            if (!$favorisCours) {

                return new JsonResponse();
            }
            $em->remove($favorisCours);
            $em->flush();
            $this->addFlash('success', 'Supprimée de favoris');
        }

        return new JsonResponse();
    }

}