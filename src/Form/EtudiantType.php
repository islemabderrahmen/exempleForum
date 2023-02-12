<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Pays;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EtudiantType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('utilisateur', UtilisateurType::class, array(
                'label' => false,
                'required' => true
            ))
            ->add('dateNaissance', BirthdayType::class, array(
                'label' => 'Date de Naissance',
                'placeholder' => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
                'format' => 'dd-MM-yyyy',
                'years' => range(date('Y'), date('Y') - 70),
            ))
            ->add('sexe', ChoiceType::class, array(
                'label' => 'Sexe',
                'choices' => array(
                    'Homme' => 'Homme',
                    'Femme' => 'Femme'
                ),
                'placeholder' => 'Sexe'
            ))
            ->add('telephone', TextType::class, array(
                'label' => 'Téléphone',
            ))
            ->add('adresse', TextType::class, array(
                'label' => 'Adresse',
                'required' => false,
            ))
            ->add('Ville', TextType::class, array(
                'label' => 'Ville',
                'required' => false,
            ))
            ->add('Pays', EntityType::class, array(
                'class' => Pays::class,
                'placeholder' => 'Pays',
                'choice_label' => 'nameFr',
                'label' => 'Pays',
            ))
            ->add('avatar', AvatarType::class, array(
                'label' => 'Photo de profil',
                'required' => false
            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Etudiant::class,
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