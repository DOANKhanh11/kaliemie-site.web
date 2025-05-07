<?php

namespace App\Form;

use App\Entity\Infirmiere;
use App\Entity\Patient;
use App\Entity\Visite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Visite1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datePrevue', null, [
                'widget' => 'single_text',
            ])
            ->add('dateReelle', null, [
                'widget' => 'single_text',
            ])
            ->add('duree')
            ->add('compteRenduInfirmiere')
            ->add('compteRenduPatient')
            ->add('patient', EntityType::class, [
                'class' => Patient::class,
                'choice_label' => 'id',
            ])
            ->add('infirmiere', EntityType::class, [
                'class' => Infirmiere::class,
                'choice_label' => 'id',
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
