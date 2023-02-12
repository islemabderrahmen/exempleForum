<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Cours;
use App\Entity\Image;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, array(
                'label' => 'titre',
            ))
            ->add('description', CKEditorType::class)
            ->add('niveau', ChoiceType::class, array(
                'choices' => array(
                    'debutant' => 'debutant',
                    'intermediaire' => 'intermediaire'
                ),
                'placeholder' => ' choisir '
            ))
            ->add('categorie', EntityType::class, array(
                'label' => 'Catégorie',
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir'
            ))
            ->add('image', ImageType::class, array(
                'label' => 'Image',
                'required' => is_null($builder->getData()->getId())

            ))
            ->add('video', MediaVideoType::class, array(
                'label' => false,
                'required' => false

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
