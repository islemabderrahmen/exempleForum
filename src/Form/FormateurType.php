<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Formateur;
use App\Entity\Pays;
use Doctrine\ORM\EntityManagerInterface;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FormateurType extends AbstractType
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
            ->add('description', CKEditorType::class, array(
                'label' => 'Déscription',
            ))
            ->add('categories', EntityType::class, array(
                'label' => 'Catégories',
                'class'=> Categorie::class,
                'choice_label'=> 'nom',
                'multiple'=> true
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
            ->add('facebook', TextType::class, array(
                'label' => 'Facebook',
                'required' => false,
            ))
            ->add('googlePlus', TextType::class, array(
                'label' => 'Google+',
                'required' => false,
            ))
            ->add('linkedin', TextType::class, array(
                'label' => 'Linkedin',
                'required' => false,
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
            'data_class' => Formateur::class,
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