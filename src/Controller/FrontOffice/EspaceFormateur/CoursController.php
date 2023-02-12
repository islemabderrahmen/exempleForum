<?php

namespace App\Controller\FrontOffice\EspaceFormateur;

use App\Entity\Cours;
use App\Entity\Notification;
use App\Form\CoursType;
use App\Listener\CoursFavorisListener;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/", name="espace_formateur_cours_liste")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function liste(Request $request, PaginatorInterface $paginator)
    {
        $formateur = $this->getUser()->getFormateur();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Cours')->findBy(array('formateur' => $formateur), array('id' => 'desc'));
        $cours = $paginator->paginate($qb, $request->query->get('page', 1), 20);

        return $this->render('front_office/espace_formateur/cours/liste.html.twig', array(
            'cours' => $cours
        ));
    }


    /**
     * @Route("/ajouter", name="espace_formateur_cours_ajouter")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function ajouter(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Cours();

        $form = $this->createForm(CoursType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formateur = $this->getUser()->getFormateur();
            $entity->setFormateur($formateur);
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('espace_formateur_cours_liste');
        }

        return $this->render('front_office/espace_formateur/cours/ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/modifier/{id}", name="espace_formateur_cours_modifier")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function modifier(Request $request, Cours $entity)
    {
        $formateur = $this->getUser()->getFormateur();
        if ($entity && !$entity->getFormateur() === $formateur) {
            throw $this->createNotFoundException('Cours n\'existe');
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CoursType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Modification avec succès');
            return $this->redirectToRoute('espace_formateur_cours_liste');
        }

        return $this->render('front_office/espace_formateur/cours/modifier.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="espace_formateur_cours_supprimer")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function supprimer(Request $request, Cours $entity)
    {
        $formateur = $this->getUser()->getFormateur();
        if ($entity && !$entity->getFormateur() === $formateur) {
            throw $this->createNotFoundException('Cours n\'existe');
        }

        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest() && $entity) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            $this->addFlash('success', 'Suppression avec succès');
        }
        return new JsonResponse();
    }

    /**
     * @Route("/mes-favoris", name="espace_formateur_cours_en_favoris")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function listeEnFavoris(Request $request, PaginatorInterface $paginator)
    {
        $utilisateur = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:FavorisCours')->findBy(array('utilisateur' => $utilisateur), array('id' => 'desc'));
        $favoris = $paginator->paginate($qb, $request->query->get('page', 1), 20);

        return $this->render('front_office/espace_formateur/cours/liste_en_favoris.html.twig', array(
            'favoris' => $favoris
        ));
    }

    /**
     * @Route("/etudiants-inscris/cours/{id}", name="espace_formateur_cours_etudiant_inscris")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function listeEtudiantsInscrisParCours(Request $request, PaginatorInterface $paginator, Cours $cours)
    {
        $utilisateur = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:SuivreCours')->findBy(array('cours' => $cours));
        $listeEtudiantsInscris = $paginator->paginate($qb, $request->query->get('page', 1), 30);

        $notificationsNonVu = $em->getRepository(Notification::class)->findBy(
            array('utilisateur' => $utilisateur,
                'vu' => false,
                'type' => 'inscription_cours',
                'url' => $this->generateUrl('espace_formateur_cours_etudiant_inscris', array('id' => $cours->getId()))));
        foreach ($notificationsNonVu as $notif) {
            $notif->setVu(true);
            $em->flush();
        }

        return $this->render('front_office/espace_formateur/cours/participants.html.twig', array(
            'listeEtudiantsInscris' => $listeEtudiantsInscris
        ));
    }
}