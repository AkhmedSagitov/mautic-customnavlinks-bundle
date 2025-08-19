<?php

namespace MauticPlugin\LeuchtfeuerCustomNavlinksBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MenuItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sub_name', TextType::class, [
                'label' => 'Sub Name',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('sub_url', TextType::class, [
                'label' => 'Sub URL',
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ]);
    }
}