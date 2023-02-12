<?php

namespace App\Controller\FrontOffice\EspacePublique;

use App\Entity\Message;
use App\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class DefaultController
 * @package App\Controller\FrontOffice\EspaceFormateur
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="front_accueil")
     */
    public function accueil(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $slideshow = $em->getRepository('App:Slideshow')->findBy(array('active' => true), array('displayOrder' => 'asc'));
        $cours = $em->getRepository('App:Cours')->findBy(array(), array('id' => 'desc'), 8, 0);
        $nbcours = $em->getRepository('App:Cours')->nombreCours();

        foreach ($cours as $cour){
            $totalEvaluation = $em->getRepository('App:EvaluationCours')->totalParCours($cour);
            $nombreEvaluation = $em->getRepository('App:EvaluationCours')->nombreParCours($cour);
            $nombreEtoiles = 0;
            if ($totalEvaluation > 0 && $nombreEvaluation > 0) {
                $nombreEtoiles = intval($totalEvaluation / $nombreEvaluation);
                $cour->setNombreEtoiles($nombreEtoiles);
            }
        }

        return $this->render('front_office/espace_publique/default/accueil.html.twig', array(
            'slideshow' => $slideshow,
            'cours' => $cours,
            'nbCours' => $nbcours
        ));
    }

    public function header(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('App:Categorie')->findAll();
        return $this->render('front_office/includes/header.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/nos-formateurs", name="front_nos_formateurs")
     */
    public function nosFormateurs(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $formateurs = $em->getRepository('App:Formateur')->findAll();

        return $this->render('front_office/espace_publique/default/nos_formateurs.html.twig', array(
            'formateurs' => $formateurs
        ));
    }

    /**
     * @Route("/contactez-nous", name="front_contact")
     */
    public function contact(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Message();

        $form = $this->createForm(MessageType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Message envoyé avec succès');
            return $this->redirectToRoute('front_contact');
        }
        return $this->render('front_office/espace_publique/default/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

}