<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('slug')
            ->add('commentaire', CKEditorType::class)
            ->add('created_at', DateType::class)
            ->add('active')
            ->add('user')
            ->add('famille')
            ->add('tatouage')
            ->add('puce')
            ->add('Validez', SubmitType::class)   
        ;
    }
  
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
