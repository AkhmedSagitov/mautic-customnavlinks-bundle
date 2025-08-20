<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeatureSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
/*        $builder
            ->add('name_1', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'row_attr' => ['class' => 'col-md-3'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('label', TextType::class, [
                'label' => 'Label',
                'required' => true,
                'row_attr' => ['class' => 'col-md-3'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('order', IntegerType::class, [
                'label' => 'Order',
                'required' => true,
                'row_attr' => ['class' => 'col-md-2'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('url', UrlType::class, [
                'label' => 'URL',
                'required' => true,
                'row_attr' => ['class' => 'col-md-2'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'required' => true,
                'row_attr' => ['class' => 'col-md-2'],
                'attr' => ['class' => 'form-control'],
                'choices' => [
                    'Blank' => 'blank',
                    'iFrame' => 'iframe',
                ],
            ]);*/

    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefined('integration');

       $resolver->setDefault('default_theme', '@LeuchtfeuerCustomNavlinks/FormTheme/Custom.html.twig');
       $resolver->setAllowedTypes('default_theme', 'string');
    }
}
