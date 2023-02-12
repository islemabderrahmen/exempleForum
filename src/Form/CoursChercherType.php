<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Cours;
use App\Entity\Formateur;
use App\Entity\Image;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursChercherType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motCle', TextType::class, array(
                'label' => 'Mot clé',
                'required' => false,
                'attr'=> array(
                    'placeholder'=> 'Un mot clé'
                )
            ))
            ->add('niveau', ChoiceType::class, array(
                'choices' => array(
                    'debutant' => 'debutant',
                    'intermediaire' => 'intermediaire'
                ),
                'placeholder' => ' choisir ',
                'required' => false,
                'attr'=> array(
                    'class'=> 'find_course_search', 'style'=> 'display: none;'
                )
            ))
            ->add('categorie', EntityType::class, array(
                'label' => 'Catégorie',
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir',
                'required' => false,
                'attr'=> array(
                    'class'=> 'find_course_search', 'style'=> 'display: none;'
                )
            ))
            ->add('formateur', EntityType::class, array(
                'label' => 'Formateur',
                'class' => Formateur::class,
                'choice_label' => 'nomUnique',
                'placeholder' => 'Choisir',
                'required' => false,
                'attr'=> array(
                    'class'=> 'find_course_search hidden'
                )
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Cours::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return null;
    }


}
