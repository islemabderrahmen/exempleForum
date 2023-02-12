<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Cours;
use App\Entity\Image;
use App\Entity\Message;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array(
                'label' => '',
                'attr'=> array(
                    'placeholder'=> 'Nom et prénom'
                )
            ))
            ->add('email', EmailType::class, array(
                'label'=> '',
                'attr'=> array(
                    'placeholder'=> 'Email'
                )
            ))
            ->add('telephone', TextType::class, array(
                'label'=> '',
                'attr'=> array(
                    'placeholder'=> 'Téléphone'
                )
            ))
            ->add('sujet', TextType::class, array(
                'label' => '',
                'attr'=> array(
                    'placeholder'=> 'Sujet'
                )
            ))
            ->add('contenu', TextareaType::class, array(
                'label'=> '',
                'attr'=> array(
                    'placeholder'=> 'Votre message', 'class'=> 'contact-message'
                )
            ))
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Message::class
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
