<?php

namespace App\Form;

use App\Entity\Infirmiere;
use App\Entity\Personne;
use App\Entity\PersonneLogin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfirmiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fichierPhoto')
            ->add('personneLogin', EntityType::class, [
                'class' => PersonneLogin::class,
                'choice_label' => 'login',
            ])
            ->add('idPersonne', EntityType::class, [
                'class' => Personne::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Infirmiere::class,
        ]);
    }
}
