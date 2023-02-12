<?php

namespace App\Controller\FrontOffice\EspacePublique;

use App\Entity\Categorie;
use App\Entity\Cours;
use App\Form\CoursChercherType;
use App\Listener\CoursFavorisListener;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class DefaultController
 */
class CoursController extends AbstractController
{

    /**
     * @Route("/cours", name="front_cours_liste")
     */
    public function listeCours(Request $request, PaginatorInterface $paginator, CoursFavorisListener $coursFavorisListener)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Cours')->findBy(array(), array('id' => 'desc'));
        $cours = $paginator->paginate($qb, $request->query->get('page', 1), 8);
        $coursEnFavoris = $coursFavorisListener->getCoursEnFavoris();

        foreach ($cours as $cour){
            $totalEvaluation = $em->getRepository('App:EvaluationCours')->totalParCours($cour);
            $nombreEvaluation = $em->getRepository('App:EvaluationCours')->nombreParCours($cour);
            $nombreEtoiles = 0;
            if ($totalEvaluation > 0 && $nombreEvaluation > 0) {
                $nombreEtoiles = intval($totalEvaluation / $nombreEvaluation);
                $cour->setNombreEtoiles($nombreEtoiles);
            }
        }

        return $this->render('front_office/espace_publique/cours/liste.html.twig', array(
            'cours' => $cours,
            'coursEnFavoris' => $coursEnFavoris,
        ));
    }

    /**
     * @Route("/cours/categorie/{slug}", name="front_cours_liste_par_categorie")
     */
    public function listeCoursParCategorie(Request $request, PaginatorInterface $paginator, CoursFavorisListener $coursFavorisListener, Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Cours')->findBy(array('categorie' => $categorie), array('id' => 'desc'));
        $cours = $paginator->paginate($qb, $request->query->get('page', 1), 8);
        $coursEnFavoris = $coursFavorisListener->getCoursEnFavoris();

        foreach ($cours as $cour){
            $totalEvaluation = $em->getRepository('App:EvaluationCours')->totalParCours($cour);
            $nombreEvaluation = $em->getRepository('App:EvaluationCours')->nombreParCours($cour);
            $nombreEtoiles = 0;
            if ($totalEvaluation > 0 && $nombreEvaluation > 0) {
                $nombreEtoiles = intval($totalEvaluation / $nombreEvaluation);
                $cour->setNombreEtoiles($nombreEtoiles);
            }
        }

        return $this->render('front_office/espace_publique/cours/liste.html.twig', array(
            'cours' => $cours,
            'coursEnFavoris' => $coursEnFavoris,
        ));
    }

    /**
     * @Route("/cours/voir/{slug}", name="front_cours_voir")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function voir(Cours $cours, CoursFavorisListener $coursFavorisListener)
    {
        $em = $this->getDoctrine()->getManager();

        $coursDejaEnFavoris = $coursFavorisListener->verifierSiCoursDejaEnFavoris($cours);
        $coursDejaEnSuivre = $em->getRepository('App:SuivreCours')->findOneBy(array('cours' => $cours, 'utilisateur' => $this->getUser()));
        $categories = $em->getRepository('App:Categorie')->findAll();
        $utilisateurAdejaEvalueCeCours = $em->getRepository('App:EvaluationCours')->findOneBy(array(
            'cours' => $cours, 'utilisateur' => $this->getUser()
        ));

        $totalEvaluation = $em->getRepository('App:EvaluationCours')->totalParCours($cours);
        $nombreEvaluation = $em->getRepository('App:EvaluationCours')->nombreParCours($cours);
        $nombreEtoiles = 0;
        if ($totalEvaluation > 0 && $nombreEvaluation > 0) {
            $nombreEtoiles = intval($totalEvaluation / $nombreEvaluation);
        }

        $nombreQuiz = $em->getRepository('App:Quiz')->nombreQuizParCours($cours->getId());
        return $this->render('front_office/espace_publique/cours/voir.html.twig', array(
            'cours' => $cours,
            'coursDejaEnFavoris' => $coursDejaEnFavoris,
            'coursDejaEnSuivre' => $coursDejaEnSuivre,
            'categories' => $categories,
            'utilisateurAdejaEvalueCeCours' => $utilisateurAdejaEvalueCeCours,
            'nombreEtoiles' => $nombreEtoiles,
            'totalEvaluation' => $totalEvaluation,
            'nombreEvaluation' => $nombreEvaluation,
            'nombreQuiz'=> $nombreQuiz

        ));
    }


    /**
     * @Route("/cours/chercher", name="front_cours_chercher")
     */
    public function search(Request $request, PaginatorInterface $paginator, CoursFavorisListener $coursFavorisListener)
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->query->all();
        $qb = $em->getRepository('App:Cours')->chercher($data);
        $cours = $paginator->paginate($qb, $request->query->get('page', 1), 12);
        $coursEnFavoris = $coursFavorisListener->getCoursEnFavoris();

        if ($request->isXmlHttpRequest()) {
            $view = $this->renderView('front_office/espace_publique/cours/liste.html.twig', array(
                'cours' => $cours,
                'coursEnFavoris' => $coursEnFavoris,
            ));

            return new Response($view);
        }

        return $this->render('front_office/espace_publique/cours/liste.html.twig', array(
            'cours' => $cours,
            'coursEnFavoris' => $coursEnFavoris,
        ));
    }

    public function formRecherchevertical(Request $request)
    {
        $form = $this->createForm(CoursChercherType::class)->handleRequest($request);

        return $this->render('front_office/espace_publique/cours/form_recherche_vertical.html.twig', array(
            'form_recherche' => $form->createView(),
        ));
    }

    public function formRechercheHorizontal(Request $request)
    {
        $form = $this->createForm(CoursChercherType::class)->handleRequest($request);

        return $this->render('front_office/espace_publique/cours/form_recherche_horizontal.html.twig', array(
            'form_recherche' => $form->createView(),
        ));
    }
}