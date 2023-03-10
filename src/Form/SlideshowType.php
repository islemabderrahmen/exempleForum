<?php
namespace App\Form;

use App\Entity\Slideshow;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SlideshowType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
    	$builder
            ->add('title', TextType::class, array(
                'required'=> false,
                'label'=> 'Titre (max 70 caractères)'
            ))
    	;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $object = $event->getData();
            $form = $event->getForm();

            $form->add('active', CheckboxType::class, array(
                'label' => 'Activer',
                'required' => false,
                'attr' => array('checked' => !$object || !$object->getId())
            ));

            $form->add('file', FileType::class, array(
                'required' => !$object || !$object->getId(),
                'label'=>false,
            ));
        });
  	}


	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => Slideshow::class,
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
