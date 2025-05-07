<?php

namespace App\Form;

use App\Entity\Visite;
use App\Entity\Patient;
use App\Entity\Soins;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('patient', EntityType::class, [
                'class' => Patient::class,
                'choice_label' => function (Patient $patient) {
                    return $patient->getIdPersonne()->getNom() . ' ' . $patient->getIdPersonne()->getPrenom();
                },
                'label' => 'Patient',
                'placeholder' => 'Sélectionner un patient'
            ])
            ->add('datePrevue', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Date prévue'
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée (minutes)'
            ])
            ->add('compteRenduInfirmiere', TextareaType::class, [
                'required' => false,
                'label' => 'Compte rendu infirmière'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Visite::class,
        ]);
    }
}
