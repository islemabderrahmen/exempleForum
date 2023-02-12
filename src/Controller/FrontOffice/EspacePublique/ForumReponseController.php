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
 * @Route("/forum/reponse")
 */
class ForumReponseController extends AbstractController
{

    public function formReponse(Request $request)
    {
        $form = $this->createForm(ForumReponseType::class)->handleRequest($request);

        return $this->render('front_office/espace_publique/forum/form_reponse.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/reponse/modifier/{id}", name="espace_publique_forum_reponse_modifier")
     * @Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function modifier(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('App:ForumReponse')->find($id);

        $form = $this->createForm(ForumReponseType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Modification avec succès');
            return $this->redirectToRoute('espace_publique_forum_question_voir', array(
                'slug'=> $entity->getQuestion()->getSlug()
            ));
        }

        return $this->render('front_office/espace_publique/forum/modifier_reponse.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="espace_publique_forum_reponse_supprimer")
     * Security("is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function supprimer(Request $request, ForumReponse $entity)
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