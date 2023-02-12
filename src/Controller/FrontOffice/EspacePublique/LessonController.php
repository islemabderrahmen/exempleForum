<?php

namespace App\Controller\FrontOffice\EspacePublique;

use App\Entity\Lesson;
use App\Listener\CoursFavorisListener;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 * @Route("/lesson")
 */
class LessonController extends AbstractController
{

    /**
     * @Route("/voir/{slug}", name="front_lesson_voir")
     * Security("has_role('ROLE_FORMATEUR')")
     */
    public function voir(Request $request, CoursFavorisListener $coursFavorisListener, Lesson $lesson)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('App:Categorie')->findAll();
        $coursDejaEnFavoris = $coursFavorisListener->verifierSiCoursDejaEnFavoris($lesson->getCours());

        $nombreQuiz = $em->getRepository('App:Quiz')->nombreQuizParCours($lesson->getCours()->getId());
        $quizEtudiant = $em->getRepository('App:QuizEtudiant')->findOneBy(array('lesson' => $lesson, 'etudiant' => $this->getUser()->getEtudiant()));
        $reponseEtudiant = $em->getRepository('App:QuizReponse')->mesReponse($lesson, $this->getUser()->getEtudiant());

        return $this->render('front_office/espace_publique/lessons/voir.html.twig', array(
            'lesson' => $lesson,
            'categories' => $categories,
            'coursDejaEnFavoris' => $coursDejaEnFavoris,
            'nombreQuiz' => $nombreQuiz,
            'quizEtudiant' => $quizEtudiant,
            'reponseEtudiant'=> $reponseEtudiant
        ));
    }

}