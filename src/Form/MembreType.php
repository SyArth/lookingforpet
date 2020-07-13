<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',null, [
                'label'=> 'Votre nom'
            ])
            ->add('prenom', null, [
                'label'=> 'Votre prénom'
            ])
            ->add('telephone', null, [
                'label'=> 'Votre nunéro de téléphone'
            ])
            ->add('user')
            ->add('adresse', null, [
                'label'=> 'Votre adresse'
            ])
            ->add('Validez', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
