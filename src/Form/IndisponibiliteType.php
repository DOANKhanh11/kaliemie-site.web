<?php

namespace App\Form;

use App\Entity\Indisponibilite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IndisponibiliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de début',
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de fin',
            ])
            ->add('heureDeb', TimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Heure de début (facultatif)',
            ])
            ->add('heureFin', TimeType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label' => 'Heure de fin (facultatif)',
            ])
            ->add('categorie', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices' => [
                    'Vacances' => 1,
                    'Maladie' => 2,
                    'Formation' => 3,
                    'Autre' => 4,
                ],
                'placeholder' => 'Choisir...',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Indisponibilite::class,
        ]);
    }
}
