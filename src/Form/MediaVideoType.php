<?php

namespace App\Form;

use App\Entity\MediaVideo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MediaVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', TextType::class, array(
                'label' => 'Url vidéo',
            ))
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => MediaVideo::class,
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