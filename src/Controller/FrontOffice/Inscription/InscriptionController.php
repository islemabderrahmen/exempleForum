<?php

namespace App\Controller\FrontOffice\Inscription;

use App\Entity\Administrateur;
use App\Entity\Etudiant;
use App\Entity\Formateur;
use App\Entity\Notification;
use App\Entity\Utilisateur;
use App\Form\EtudiantType;
use App\Form\FormateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class InscriptionController extends Controller
{

    /**
     * @param Request $request
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     *
     * @Route("/inscription/etudiant", name="front_inscription_etudiant")
     */
    public function inscriptionEtudiant(Request $request, AuthorizationCheckerInterface $authorizationChecker, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('front_accueil');
        }

        $etudiant = new Etudiant();

        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $etudiant->getUtilisateur();
            $user->addRole('ROLE_ETUDIANT');
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

            $administrateurs = $em->getRepository(Administrateur::class)->findAll();
            foreach ($administrateurs as $administrateur) {
                $notification = new Notification();
                $notification->setType('inscription_etudiant');
                $notification->setDescription('Nouvelle inscription étudiant');
                $notification->setUtilisateur($administrateur->getUtilisateur());
                $em->persist($notification);
                $em->flush();
            }

            //auto-login
            //Handle getting or creating the user entity likely with a posted form
            // The third parameter "main" can change according to the name of your firewall in security.yml
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);

            // If the firewall name is not main, then the set value would be instead:
            // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
            $this->get('session')->set('_security_main', serialize($token));

            // Fire the login event manually
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            $user->setDernierConnexion(new \DateTime());
            $em->flush();
            return $this->redirectToRoute('front_accueil');
        }

        return $this->render('front_office/inscription/inscription_etudiant.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     *
     * @Route("/inscription/formateur", name="front_inscription_formateur")
     */
    public function inscriptionFormateur(Request $request, AuthorizationCheckerInterface $authorizationChecker, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('front_accueil');
        }

        $formateur = new Formateur();
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $formateur->getUtilisateur();
            $user->addRole('ROLE_FORMATEUR');
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($formateur);
            $em->flush();

            $administrateurs = $em->getRepository(Administrateur::class)->findAll();
            foreach ($administrateurs as $administrateur) {
                $notification = new Notification();
                $notification->setType('inscription_formateur');
                $notification->setDescription('Nouvelle inscription formateur');
                $notification->setUtilisateur($administrateur->getUtilisateur());
                $em->persist($notification);
                $em->flush();
            }

            //auto-login
            //Handle getting or creating the user entity likely with a posted form
            // The third parameter "main" can change according to the name of your firewall in security.yml
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);

            // If the firewall name is not main, then the set value would be instead:
            // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
            $this->get('session')->set('_security_main', serialize($token));

            // Fire the login event manually
            $event = new InteractiveLoginEvent($request, $token);
            $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            $user->setDernierConnexion(new \DateTime());
            $em->flush();
            return $this->redirectToRoute('front_accueil');
        }


        return $this->render('front_office/inscription/inscription_formateur.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
