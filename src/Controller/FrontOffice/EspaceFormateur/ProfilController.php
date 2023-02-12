<?php

namespace App\Controller\FrontOffice\EspaceFormateur;

use App\Entity\Notification;
use App\Form\ChangerEmailType;
use App\Form\ChangerMotDePasseType;
use App\Form\FormateurType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class ProfilController
 * @package App\Controller\FrontOffice\EspaceFormateur
 *
 * @Route("/profil")
 */
class ProfilController extends AbstractController
{

    public function leftSide()
    {
        $formateur = $this->getUser()->getFormateur();
        return $this->render('front_office/espace_formateur/includes/left_side.html.twig', array(
            'formateur' => $formateur,
        ));
    }

    public function notification()
    {
        $user = $this->getUser();
        $notifications = $this->getDoctrine()->getManager()->getRepository(Notification::class)
            ->findBy(array('utilisateur'=>$user), array('id'=>'desc'));

        $countNotifNonVu = $this->getDoctrine()->getManager()->getRepository(Notification::class)
            ->findBy(array('utilisateur'=>$user, 'vu'=> false));

        return $this->render('front_office/espace_formateur/includes/notification.html.twig', array(
            'notifications' => $notifications,
            'countNotifNonVu'=> count($countNotifNonVu)
        ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="front_espace_formateur_profil_voir")
     * @Security("has_role('ROLE_FORMATEUR') and is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function show()
    {
        $formateur = $this->getUser()->getFormateur();
        return $this->render('front_office/espace_formateur/profil/voir.html.twig', array(
            'formateur' => $formateur,
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/modifier", name="front_espace_formateur_profil_modifier")
     * @Security("has_role('ROLE_FORMATEUR') and is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function edit(Request $request)
    {
        $utilisateur = $this->getUser();
        $formateur = $utilisateur->getFormateur();
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->get('utilisateur')->remove('email')->remove('plainPassword');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Modifiaction avec succès');

            return $this->redirectToRoute('front_espace_formateur_profil_voir');
        }

        return $this->render('front_office/espace_formateur/profil/modifier.html.twig', array(
            'form' => $form->createView(),
            ''
        ));
    }
    
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/changer-email", name="front_espace_formateur_profil_changer_email")
     * @Security("has_role('ROLE_FORMATEUR') and is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function changerEmail(Request $request)
    {
        $utilisateur = $this->getUser();
        $form = $this->createForm(ChangerEmailType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $currentEmail = $utilisateur->getEmail();
            $newEmail = $form->get('email')->getData();
            $currentPassword = $form->get('currentPassword')->getData();

            // verify if the tow emails are different
            if ($currentEmail === $newEmail) {
                $form->get('email')->addError(new FormError('Vous devez choisir un email différent.'));
            }

            // verify if the email is used by another user
            $utilisateurHasAlreadyThisEmail = $em->getRepository('App:Utilisateur')->findOneBy(array('email' => $newEmail));
            if ($utilisateurHasAlreadyThisEmail && $utilisateurHasAlreadyThisEmail !== $utilisateur) {
                $form->get('email')->addError(new FormError('Cet email est déjà utilisé.'));
            }

            // verify if the password is correct
            $verify = $this->verify($currentPassword, $utilisateur->getPassword());
            if ($verify === false) {
                $form->get('currentPassword')->addError(new FormError('Mot de passe incorrect.'));
            }
            if ($form->isValid()) {
                $this->addFlash('success', 'L\'email a été modifié avec succés.');
                $utilisateur->setEmail($newEmail);
                $em->flush();
                return $this->redirectToRoute('front_espace_formateur_profil_voir');
            }
        }

        return $this->render('front_office/espace_formateur/profil/changer_email.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/changer-mot-de-passe", name="front_espace_formateur_profil_changer_mot_de_passe")
     * @Security("has_role('ROLE_FORMATEUR') and is_granted('IS_AUTHENTICATED_REMEMBERED')")
     */
    public function changerMotDePasse(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $utilisateur = $this->getUser();

        $form = $this->createForm(ChangerMotDePasseType::class, $utilisateur);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $currentPassword = $form->get('currentPassword')->getData();
            $verify = $this->verify($currentPassword, $utilisateur->getPassword());

            if (false === $currentPassword || empty($currentPassword)) {
                $form->get('currentPassword')->addError(new FormError('Mot de passe ne doit pas être vide.'));
            }

            if ($verify === false) {
                $form->get('currentPassword')->addError(new FormError('Mot de passe incorrect.'));
            }

            if ($form->isValid()) {
                $password = $passwordEncoder->encodePassword($utilisateur, $utilisateur->getPlainPassword());
                $utilisateur->setPassword($password);
                $this->addFlash('success', 'Le mot de passe a été modifié avec succés.');
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('front_espace_formateur_profil_voir');
            }
        }

        return $this->render('front_office/espace_formateur/profil/changer_mot_de_passe.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function verify($input, $existingHash)
    {
        $hash = password_verify($input, $existingHash);

        return $hash === true;
    }
    

}