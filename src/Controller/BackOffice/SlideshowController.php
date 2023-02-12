<?php

namespace App\Controller\BackOffice;

use App\Entity\Slideshow;
use App\Form\SlideshowType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class SlideshowController
 * @package App\Controller
 * @Route("/slideshow")
 */
class SlideshowController extends AbstractController
{
    /**
     * @Route("/", name="back_slideshow_liste")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function liste(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Slideshow')->findBy(array(), array('displayOrder'=> 'asc'));
        $entities = $paginator->paginate($qb, $request->query->get('page', 1), 50);

        return $this->render('back_office/slideshow/liste.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * @Route("/voir/{id}", name="back_slideshow_voir")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function voir(Slideshow $entity)
    {
        return $this->render('back_office/slideshow/voir.html.twig', array(
            'entity' => $entity
        ));
    }

    /**
     * @Route("/ajouter", name="back_slideshow_ajouter")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ajouter(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Slideshow();

        $form = $this->createForm(SlideshowType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $lastSlideshow = $em->getRepository('App:Slideshow')->findOneBy(array(), array('displayOrder' => 'desc'));
            if($lastSlideshow){
                $entity->setDisplayOrder($lastSlideshow->getDisplayOrder() + 1);
            }
            else{
                $entity->setDisplayOrder(0);
            }
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('back_slideshow_liste');
        }

        return $this->render('back_office/slideshow/ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/modifier/{id}", name="back_slideshow_modifier")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function modifier(Request $request, Slideshow $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SlideshowType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Modification avec succès');
            return $this->redirectToRoute('back_slideshow_liste');
        }

        return $this->render('back_office/slideshow/modifier.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="back_slideshow_supprimer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function supprimer(Request $request, Slideshow $entity)
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest() && $entity) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            $this->addFlash('success', 'Suppression avec succès');
        }
        return new JsonResponse();
    }

    /**
     * @Route("/activer/{id}", name="back_slideshow_activer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function activer(Request $request, Slideshow $entity)
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest() && $entity) {
            $em = $this->getDoctrine()->getManager();
            if ($entity->getActive()) {
                $entity->setActive(false);
            } else {
                $entity->setActive(true);
            }
            $em->flush();
            $this->addFlash('success', 'Activation avec succès');
        }
        return new JsonResponse();
    }
    
    /**
     * Reorder list
     *
     * @Route("/reorder", name="back_slideshow_reorder")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function reorder(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $order = explode(',', $request->request->get('order'));
        $count = \count($order);
        for ($i = 0; $i < $count; $i++) {
            $entity = $em->getRepository('App:Slideshow')->find($order[$i]);
            if ($entity) {
                $entity->setDisplayOrder($i);
            }
        }
        $em->flush();
        $this->addFlash('success', 'Modification avec succès');

        return new JsonResponse();

    }

}