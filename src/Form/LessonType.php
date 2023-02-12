<?php

namespace App\Form;

use App\Entity\Lesson;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
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
            ->add('duree', IntegerType::class, array(
                'label' => 'durrée en minutes',
                'attr' => array(
                    'min' => 1
                )
            ))
            ->add('description', CKEditorType::class)
            ->add('document', DocumentType::class, array(
                'label' => 'Document',
                'required'=> false

            ))
            ->add('image', ImageType::class, array(
                'label' => 'Image',
                'required' => false

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
            'data_class' => Lesson::class
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
