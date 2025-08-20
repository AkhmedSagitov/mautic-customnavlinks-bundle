<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Form\Type;

use MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Entity\MenuItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('label')
            ->add('sortOrder')
            ->add('url')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Blank' => 'blank',
                    'iFrame' => 'iFrame',
                ],
                'placeholder' => 'Select type', // optional
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
