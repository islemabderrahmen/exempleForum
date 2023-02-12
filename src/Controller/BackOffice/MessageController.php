<?php

namespace App\Controller\BackOffice;

use App\Entity\Message;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class MessageController
 * @package App\Controller
 * @Route("/message-received")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="back_message_liste")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function liste(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Message')->findBy(array(), array('id'=> 'desc'));
        $entities = $paginator->paginate($qb, $request->query->get('page', 1), 40);

        return $this->render('back_office/messages/liste.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * @Route("/voir/{id}", name="back_message_voir")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function voir(Message $entity)
    {
        $entity->setLu(true);
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->render('back_office/messages/voir.html.twig', array(
            'entity' => $entity
        ));
    }

    /**
     * @Route("/supprimer/{id}", name="back_message_supprimer")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function supprimer(Request $request, Message $entity)
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