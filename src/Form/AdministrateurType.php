<?php

namespace App\Form;

use App\Entity\Administrateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AdministrateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('utilisateur', UtilisateurType::class, array(
                'label' => false,
                'required' => true
            ))
            ->add('mobile', TextType::class, array(
                'label' => 'Téléphone mobile',
            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Administrateur::class,
        ));
    }

    public function getBlockPrefix()
    {
        return null;
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}