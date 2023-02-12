<?php

namespace App\Controller\FrontOffice\EspaceEtudiant;

use App\Entity\Lesson;
use App\Entity\Quiz;
use App\Entity\QuizEtudiant;
use App\Entity\QuizReponse;
use App\Form\QuizType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/quiz")
 */
class QuizController extends AbstractController
{

    /**
     * @Route("/repondre/{id_lesson}", name="espace_etudiant_quiz_repondre")
     * @Security("has_role('ROLE_ETUDIANT')")
     */
    public function repondre(Request $request, $id_lesson)
    {
        $em = $this->getDoctrine()->getManager();
        $lesson = $em->getRepository('App:Lesson')->find($id_lesson);
        $quizs = $em->getRepository('App:Quiz')->findByLesson($lesson);
        $etudiant = $this->getUser()->getEtudiant();
        $nombreQuestion = count($quizs);
        $nombreReponseJuste = 0;
        foreach ($quizs as $quiz) {
            if (isset($_POST['choix-' . $quiz->getId()])) {
                $choix = $_POST['choix-' . $quiz->getId()];
                $question = $em->getRepository('App:QuizQuestion')->find($choix);
                $reponse = new QuizReponse();
                $reponse->setChoix($question);
                $reponse->setQuiz($question->getQuiz());
                $reponse->setEtudiant($etudiant);
                if ($question->getJuste() === true) {
                    $reponse->setResultat(true);
                    $nombreReponseJuste++;
                } else {
                    $reponse->setResultat(false);
                }
                $em->persist($reponse);
                $em->flush();
            }
        }

        $note = ($nombreReponseJuste / $nombreQuestion) * 10 ;

        $quizEtudiant = new QuizEtudiant();
        $quizEtudiant->setEtudiant($etudiant);
        $quizEtudiant->setLesson($lesson);
        $quizEtudiant->setNote($note);
        $em->persist($quizEtudiant);
        $em->flush();

        return $this->redirectToRoute('front_lesson_voir', array('slug'=>$lesson->getSlug()));
    }

    /**
     * @Route("/modifier/{id}", name="espace_etudiant_quiz_modifier")
     * @Security("has_role('ROLE_ETUDIANT')")
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
            return $this->redirectToRoute('espace_etudiant_quiz_liste', array(
                'id' => $entity->getLesson()->getId()
            ));
        }

        return $this->render('front_office/espace_etudiant/quiz/modifier.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="espace_etudiant_quiz_supprimer")
     * @Security("has_role('ROLE_ETUDIANT')")
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
}