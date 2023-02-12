<?php

namespace App\Controller\FrontOffice\EspaceFormateur;

use App\Entity\Cours;
use App\Entity\Lesson;
use App\Entity\Notification;
use App\Entity\SuivreCours;
use App\Form\LessonType;
use App\Listener\CoursFavorisListener;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/lesson")
 */
class LessonController extends AbstractController
{

    /**
     * @Route("/liste/{id}", name="espace_formateur_lessons_liste")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function liste(Request $request, PaginatorInterface $paginator, Cours $cours)
    {
        $formateur = $this->getUser()->getFormateur();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Lesson')->findBy(array('cours' => $cours), array('id' => 'desc'));
        $lessons = $paginator->paginate($qb, $request->query->get('page', 1), 20);

        return $this->render('front_office/espace_formateur/lessons/liste.html.twig', array(
            'lessons' => $lessons,
            'cours'=> $cours
        ));
    }


    /**
     * @Route("/ajouter/{id_cours}", name="espace_formateur_lesson_ajouter")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function ajouter(Request $request, $id_cours)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Lesson();
        $cours = $em->getRepository('App:Cours')->find($id_cours);
        $form = $this->createForm(LessonType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setCours($cours);
            $em->persist($entity);
            $em->flush();

            $participants = $em->getRepository(SuivreCours::class)->findBy(array('cours'=> $cours));
            foreach ($participants as $participant) {
                $notification = new Notification();
                $notification->setType('nouveau_lesson');
                $notification->setDescription('Nouveau lesson ajouté');
                $notification->setUtilisateur($participant->getUtilisateur());
                $notification->setUrl($this->generateUrl('front_lesson_voir', array('slug'=>$entity->getSlug())));
                $em->persist($notification);

            }
            $em->flush();

            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('front_cours_voir', array(
                'slug' => $cours->getSlug()
            ));
        }

        return $this->render('front_office/espace_formateur/lessons/ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/modifier/{id}", name="espace_formateur_lesson_modifier")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function modifier(Request $request, Lesson $entity)
    {
        $formateur = $this->getUser()->getFormateur();
        if ($entity && !$entity->getCours()->getFormateur() === $formateur) {
            throw $this->createNotFoundException('Lesson n\'existe');
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(LessonType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Modification avec succès');
            return $this->redirectToRoute('front_lesson_voir', array(
                'slug' => $entity->getSlug()
            ));
        }

        return $this->render('front_office/espace_formateur/lessons/modifier.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="espace_formateur_lesson_supprimer")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function supprimer(Request $request, Lesson $entity)
    {
        $formateur = $this->getUser()->getFormateur();
        if ($entity && !$entity->getFormateur() === $formateur) {
            throw $this->createNotFoundException('Lesson n\'existe');
        }

        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest() && $entity) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            $this->addFlash('success', 'Suppression avec succès');
        }
        return new JsonResponse();
    }
}