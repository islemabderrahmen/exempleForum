<?php

namespace App\Controller\BackOffice;

use App\Entity\Administrateur as BaseEntity;
use App\Entity\Administrateur;
use App\Form\AdministrateurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AdministrateurController
 * @package App\Controller
 * @Route("/administrateur")
 */
class AdministrateurController extends AbstractController
{
    /**
     * @Route("/", name="back_administrateur_liste")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function liste(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Administrateur')->findAll();
        $entities = $paginator->paginate($qb, $request->query->get('page', 1), 40);

        return $this->render('back_office/administrateurs/liste.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * @param BaseEntity $entity
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/voir/{id}", name="back_administrateur_voir")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function voir(BaseEntity $entity)
    {
        return $this->render('back_office/administrateurs/voir.html.twig', array(
            'entity' => $entity
        ));
    }

    /**
     * @Route("/ajouter", name="back_administrateur_ajouter")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function ajouter(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Administrateur();

        $form = $this->createForm(AdministrateurType::class, $entity);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity->getUtilisateur()->setActive(true);
            $entity->getUtilisateur()->addRole('ROLE_ADMIN');
            $password = $passwordEncoder->encodePassword($entity->getUtilisateur(), $entity->getUtilisateur()->getPlainPassword());
            $entity->getUtilisateur()->setPassword($password);
            $em->persist($entity);
            $em->flush();
            $this->addFlash('success', 'Ajout avec succès');
            return $this->redirectToRoute('back_administrateur_liste');
        }

        return $this->render('back_office/administrateurs/ajouter.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/modifier/{id}", name="back_administrateur_modifier")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function modifier(Request $request, Administrateur $entity)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(AdministrateurType::class, $entity);
        $form->get('utilisateur')->remove('plainPassword');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Modification avec succès');
            return $this->redirectToRoute('back_administrateur_liste');
        }

        return $this->render('back_office/administrateurs/modifier.html.twig', array(
            'form' => $form->createView(),
            'entity'=> $entity
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="back_administrateur_supprimer")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
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

    /**
     * @Route("/activer/{id}", name="back_administrateur_activer")
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     */
    public function activer(Request $request, BaseEntity $entity)
    {
        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest() && $entity) {
            $em = $this->getDoctrine()->getManager();
            if ($entity->getUtilisateur()->getActive()) {
                $entity->getUtilisateur()->setActive(false);
            } else {
                $entity->getUtilisateur()->setActive(true);
            }
            $em->flush();
            $this->addFlash('success', 'Activation avec succès');
        }
        return new JsonResponse();
    }

}