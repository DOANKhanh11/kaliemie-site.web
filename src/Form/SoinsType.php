<?php

namespace App\Form;

use App\Entity\Soins;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoinsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idCategSoins')
            ->add('idTypeSoins')
            ->add('id')
            ->add('libel')
            ->add('description')
            ->add('coefficient')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soins::class,
        ]);
    }
}
