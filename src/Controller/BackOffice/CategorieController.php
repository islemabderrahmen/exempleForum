<?php

namespace App\Controller\BackOffice;

use App\Entity\Categorie as BaseEntity;
use App\Form\CategorieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class CategorieController
 * @package App\Controller
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{
    /**
     * @Route("/", name="back_categorie_liste")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function liste(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Categorie')->findAll();
        $entities = $paginator->paginate($qb, $request->query->get('page', 1), 40);

        return $this->render('back_office/categorie/liste.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * @Route("/ajouter", name="back_categorie_ajouter")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function ajouter(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new BaseEntity();

        $form = $this->createForm(CategorieType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('back_categorie_liste');
        }

        return $this->render('back_office/categorie/ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/modifier/{id}", name="back_categorie_modifier")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function modifier(Request $request, BaseEntity $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CategorieType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Modification avec succès');
            return $this->redirectToRoute('back_categorie_liste');
        }

        return $this->render('back_office/categorie/modifier.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="back_categorie_supprimer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function supprimer(Request $request, BaseEntity $entity)
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest() && $entity) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
            $this->addFlash('success', 'Suppression avec succès');
        }
        return new JsonResponse();
    }

}