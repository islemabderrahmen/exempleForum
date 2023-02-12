<?php

namespace App\Controller\BackOffice;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="back_accueil")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {
        return $this->render('back_office/default/index.html.twig');
    }


    public function header()
    {
        $em = $this->getDoctrine()->getManager();
        $nombreMessagesNonLu = $em->getRepository('App:Message')->nombreMessagesNonLu();
        $derniersMessages = $em->getRepository('App:Message')->findBy(array(), array('id' => 'desc'), 10, 0);

        $notifications = $em->getRepository('App:Notification')->findBy(array('utilisateur' => $this->getUser()), array('id' => 'desc'), 10, 0);

        return $this->render('back_office/includes/header.html.twig', array(
            'nombreMessagesNonLu' => $nombreMessagesNonLu,
            'derniersMessages' => $derniersMessages,
            'notifications' => $notifications
        ));
    }


}