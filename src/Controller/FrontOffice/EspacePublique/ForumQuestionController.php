<?php

namespace App\Controller\FrontOffice\EspacePublique;

use App\Entity\Categorie;
use App\Entity\Cours;
use App\Entity\ForumQuestion;
use App\Entity\ForumReponse;
use App\Form\ForumQuestionType;
use App\Form\ForumReponseType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CategoryController
 * @package App\Controller
 * @Route("/forum")
 */
class ForumQuestionController extends AbstractController
{
    /**
     * @Route("/", name="espace_publique_forum_accueil")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('App:Categorie')->findAll();

        return $this->render('front_office/espace_publique/forum/index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/categorie/{slug}", name="espace_publique_forum_questions")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function liste(Request $request, PaginatorInterface $paginator, Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:ForumQuestion')->findBy(array('categorie' => $categorie), array('ordre' => 'desc'));
        $questions = $paginator->paginate($qb, $request->query->get('page', 1), 20);

        return $this->render('front_office/espace_publique/forum/liste_question.html.twig', array(
            'questions' => $questions,
            'categorie' => $categorie
        ));
    }


    /**
     * @Route("/categorie/{slug}/ajouter", name="espace_publique_forum_question_ajouter")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function ajouter(Request $request, Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new ForumQuestion();

        $form = $this->createForm(ForumQuestionType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setUtilisateur($this->getUser());
            $entity->setCategorie($categorie);
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('espace_publique_forum_question_voir', array(
                'slug' => $entity->getSlug()
            ));
        }

        return $this->render('front_office/espace_publique/forum/ajouter_question.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/questions/modifier/{id}", name="espace_publique_forum_question_modifier")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function modifier(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('App:ForumQuestion')->find($id);

        $form = $this->createForm(ForumQuestionType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setUtilisateur($this->getUser());
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Modification avec succès');
            return $this->redirectToRoute('espace_publique_forum_question_voir', array(
                'slug'=> $entity->getSlug()
            ));
        }

        return $this->render('front_office/espace_publique/forum/modifier_question.html.twig', array(
            'form' => $form->createView(),
            'entity'=> $entity
        ));
    }


    /**
     * @Route("/questions/voir/{slug}", name="espace_publique_forum_question_voir")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function voir(Request $request, ForumQuestion $forumQuestion)
    {
        $reponse = new ForumReponse();
        $form = $this->createForm(ForumReponseType::class, $reponse);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $reponse->setUtilisateur($this->getUser());
            $reponse->setQuestion($forumQuestion);
            $em->persist($reponse);
            $forumQuestion->setOrdre(new \DateTime());
            $em->flush();

            $this->addFlash('success', 'Ajout avec succès');

            return $this->redirectToRoute('espace_publique_forum_question_voir', array(
                'slug' => $forumQuestion->getSlug()
            ));
        }

        return $this->render('front_office/espace_publique/forum/voir_question.html.twig', array(
            'question' => $forumQuestion
        ));

    }

    /**
     * @Route("/supprimer/{id}", name="espace_publique_forum_question_supprimer")
     * Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function supprimer(Request $request, ForumQuestion $entity)
    {

        if ($entity && !$entity->getUtilisateur() === $this->getUser()) {
            throw $this->createNotFoundException('Erreur');
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