<?php

namespace App\Form;

use App\Entity\Infirmiere;
use App\Entity\Patient;
use App\Entity\Personne;
use App\Entity\PersonneLogin;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('informationsMedicales')
            ->add('personneLogin', EntityType::class, [
                'class' => PersonneLogin::class,
                'choice_label' => 'login',
            ])
            ->add('idPersonne', EntityType::class, [
                'class' => Personne::class,
                'choice_label' => 'id',
            ])
            ->add('personneDeConfiance', EntityType::class, [
                'class' => Personne::class,
                'choice_label' => function (Personne $personne) {
                    return $personne->getNom() . ' ' . $personne->getPrenom();
                },
                'label' => 'Personne de confiance',
                'placeholder' => 'Sélectionner une personne',
                'required' => false,
            ])
            ->add('infirmiereSouhait', EntityType::class, [
                'class' => Infirmiere::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
