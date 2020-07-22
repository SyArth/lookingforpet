<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Class AnimalType
 * @package App\Form
 */
class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('images', FileType::class, [
                'label' => 'Choisissez une photo ou plusieurs photos de votre animal',
                'multiple'=> true,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image(['maxSize' => '1024k']),
                    new NotNull()
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Comment s\'appelle de votre compagnon ?',
                'required' => true
            ])
            ->add('commentaire', CKEditorType::class, [
                'label' => 'Notez les détails importants concernant votre compagnon (craint-il l\'homme ?)...',
                
            ])
            ->add('famille',ChoiceType::class, [
                'label' => 'Est-ce un chien ou un chat ?',
                'required' => false
            ])
            ->add('tatouage', TextType::class, [
                'label' => 'Quel est son numéro de Tatouage ?',
                'required' => false])
            ->add('puce', TextType::class, [
                'label' => 'Quel est son numéro de puce ?',
                'required' => false])
        ;
    }
  
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
