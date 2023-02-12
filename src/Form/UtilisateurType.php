<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label'=> 'Email',
                'required'=> true
            ))
            ->add('prenom', TextType::class, array(
                'label' => 'Prénom',
                'required' => true,
            ))
            ->add('nom', TextType::class, array(
                'label' => 'Nom',
                'required' => true,
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe'),
                'second_options' => array('label' => 'Confirmation'),
                'invalid_message' => 'Les deux mots de passe ne sont pas identiques'
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => true,
            'data_class' => Utilisateur::class,
            'validation_groups'=> array('registration')
        ));
    }


    public function getBlockPrefix(): ?string
    {
        return null;
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}