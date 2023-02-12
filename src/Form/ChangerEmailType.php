<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangerEmailType extends AbstractType
{
    private $tokenStorage;
    private $user;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
        $this->user = $this->tokenStorage->getToken()->getUser();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'data' => $this->user->getEmail(),
                'constraints' => array(
                    new NotBlank(array(
                            'message' => 'Email ne doit pas être vide.')
                    ),
                    new Email(array(
                        'message'=> 'Vous devez choisir un email valide.'
                    ))
                ),
            ))
            ->add('currentPassword', PasswordType::class, array(
                'label' => 'Mot de passe',
                'constraints' => array(
                    new NotBlank(array(
                            'message' => 'Mot de passe ne doit pas être vide.')
                    )
                ),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }


    public function getBlockPrefix(): ?string
    {
        return 'app_changer_email';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}