<?php

namespace App\Controller\FrontOffice\EspaceFormateur;

use App\Entity\Cours;
use App\Entity\Lesson;
use App\Entity\Quiz;
use App\Form\QuizType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/quiz")
 */
class QuizController extends AbstractController
{
    /**
     * @Route("/liste/{id}", name="espace_formateur_quiz_liste")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function liste(Request $request, PaginatorInterface $paginator, Lesson $lesson)
    {

        $formateur = $this->getUser()->getFormateur();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Quiz')->liste($formateur, $lesson);
        $quizs = $paginator->paginate($qb, $request->query->get('page', 1), 20);

        return $this->render('front_office/espace_formateur/quiz/liste.html.twig', array(
            'quizs' => $quizs,
            'lesson'=> $lesson
        ));
    }

    /**
     * @Route("/ajouter/{id_lesson}", name="espace_formateur_quiz_ajouter")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function ajouter(Request $request, $id_lesson)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Quiz();
        $lesson = $em->getRepository('App:Lesson')->find($id_lesson);

        $form = $this->createForm(QuizType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setLesson($lesson);
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('espace_formateur_quiz_liste', array(
                'id' => $lesson->getId()
            ));
        }

        return $this->render('front_office/espace_formateur/quiz/ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/modifier/{id}", name="espace_formateur_quiz_modifier")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function modifier(Request $request, Quiz $entity)
    {
        $formateur = $this->getUser()->getFormateur();
        if ($entity && !$entity->getLesson()->getCours()->getFormateur() === $formateur) {
            throw $this->createNotFoundException('Quiz n\'existe');
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(QuizType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Modification avec succès');
            return $this->redirectToRoute('espace_formateur_quiz_liste', array(
                'id'=> $entity->getLesson()->getId()
            ));
        }

        return $this->render('front_office/espace_formateur/quiz/modifier.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="espace_formateur_quiz_supprimer")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function supprimer(Request $request, Quiz $entity)
    {
        $formateur = $this->getUser()->getFormateur();
        if ($entity && !$entity->getFormateur() === $formateur) {
            throw $this->createNotFoundException('Quiz n\'existe');
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
     * @Route("/notes/cours/{id}", name="espace_formateur_quiz_notes_par_cours")
     * @Security("has_role('ROLE_FORMATEUR')")
     */
    public function notes(Request $request, PaginatorInterface $paginator, Cours $cours)
    {
        $formateur = $this->getUser()->getFormateur();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:QuizEtudiant')->notesParCours($formateur, $cours);
        $notes = $paginator->paginate($qb, $request->query->get('page', 1), 50);

        return $this->render('front_office/espace_formateur/quiz/notes.html.twig', array(
            'notes' => $notes,
            'cours'=> $cours
        ));
    }
}